<?php

namespace Tests\Feature;

use App\Models\Acao;
use App\Models\CategoriaOcorrencia;
use App\Models\ContatoOcorrencia;
use App\Models\FonteClimatica;
use App\Models\IndicadorClimatico;
use App\Models\MedicaoClimatica;
use App\Models\Ocorrencia;
use App\Models\Organizacao;
use App\Models\Pessoa;
use App\Models\PessoaContato;
use App\Models\PontoMonitoramento;
use App\Models\Territorio;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProjectSchemaTest extends TestCase
{
    use DatabaseMigrations;

    private function territory(): Territorio
    {
        return Territorio::create(['nome' => 'Goiânia', 'tipo' => 'municipio', 'codigo_oficial' => 'IBGE:5208707']);
    }

    private function report(Territorio $territory): Ocorrencia
    {
        $category = CategoriaOcorrencia::create(['nome' => 'Alagamento', 'descricao' => 'Acúmulo de água']);

        return Ocorrencia::create([
            'protocolo' => 'CLIMA-TESTE-001', 'territorio_id' => $territory->id,
            'categoria_id' => $category->id, 'titulo' => 'Rua alagada',
            'descricao' => 'Água acumulada na rua', 'ocorrido_em' => now(),
            'latitude' => -16.6869, 'longitude' => -49.2648, 'gravidade_informada' => 'alta',
        ]);
    }

    public function test_all_forty_tables_and_models_are_available_and_reversible(): void
    {
        $files = glob(database_path('migrations/2026_11_11_*'));
        $this->assertCount(40, $files);
        $foreignKeys = 0;
        foreach ($files as $file) {
            preg_match('/create_(.+)_table.php$/', $file, $match);
            $this->assertTrue(Schema::hasTable($match[1]), $match[1]);
            $foreignKeys += count(Schema::getForeignKeys($match[1]));
        }
        $this->assertSame(70, $foreignKeys);
        foreach (glob(app_path('Models/*.php')) as $file) {
            $class = 'App\\Models\\'.basename($file, '.php');
            $model = new $class;
            $this->assertTrue(Schema::hasTable($model->getTable()));
            foreach ((new \ReflectionClass($class))->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->getDeclaringClass()->getName() !== $class || $method->getNumberOfRequiredParameters() > 0) {
                    continue;
                }
                $type = $method->getReturnType();
                if ($type instanceof \ReflectionNamedType && is_a($type->getName(), Relation::class, true)) {
                    $relation = $method->invoke($model);
                    $this->assertTrue(Schema::hasTable($relation->getRelated()->getTable()));
                    $relation->getQuery()->limit(1)->get();
                }
            }
        }
        $this->artisan('migrate:rollback', ['--force' => true])->assertSuccessful();
        foreach ($files as $file) {
            preg_match('/create_(.+)_table.php$/', $file, $match);
            $this->assertFalse(Schema::hasTable($match[1]));
        }
        $this->artisan('migrate', ['--force' => true])->assertSuccessful();
    }

    public function test_reports_without_an_account_can_be_linked_to_actions_and_territories(): void
    {
        $territory = $this->territory();
        $report = $this->report($territory);
        $organization = Organizacao::create(['nome' => 'Prefeitura', 'tipo' => 'publica', 'territorio_sede_id' => $territory->id]);
        $action = Acao::create(['organizacao_id' => $organization->id, 'titulo' => 'Limpeza', 'descricao' => 'Limpar drenagem', 'criado_por_id' => $this->user()->id]);
        $action->ocorrencias()->attach($report);
        $action->territorios()->attach($territory);
        $this->assertNull($report->registrado_por_id);
        $this->assertTrue($report->acoes()->first()->is($action));
        $this->assertTrue($territory->acoes()->first()->is($action));
        $this->assertTrue($report->territorio->is($territory));
    }

    private function user(): Usuario
    {
        $person = Pessoa::create(['nome' => 'Moradora']);

        return Usuario::create(['pessoa_id' => $person->id, 'email' => 'moradora@example.test', 'password' => 'senha-teste']);
    }

    public function test_personal_contacts_are_encrypted_and_secrets_are_hidden(): void
    {
        $user = $this->user();
        $contact = PessoaContato::create(['pessoa_id' => $user->pessoa_id, 'tipo' => 'telefone', 'valor_cifrado' => '61999999999']);
        $this->assertNotSame('61999999999', DB::table('pessoa_contatos')->value('valor_cifrado'));
        $this->assertSame('61999999999', $contact->fresh()->valor_cifrado);
        $this->assertArrayNotHasKey('valor_cifrado', $contact->toArray());
        $this->assertTrue(Hash::check('senha-teste', $user->password));
        $this->assertArrayNotHasKey('password', $user->toArray());
        $report = $this->report($this->territory());
        $private = ContatoOcorrencia::create(['ocorrencia_id' => $report->id, 'email_cifrado' => 'contato@example.test']);
        $this->assertNotSame('contato@example.test', DB::table('contatos_ocorrencia')->value('email_cifrado'));
        $this->assertSame('contato@example.test', $private->fresh()->email_cifrado);
    }

    public function test_a_territory_with_reports_cannot_be_deleted(): void
    {
        $territory = $this->territory();
        $this->report($territory);
        $this->expectException(QueryException::class);
        $territory->delete();
    }

    public function test_foreign_keys_reject_nonexistent_people(): void
    {
        $this->expectException(QueryException::class);
        Usuario::create(['pessoa_id' => 999, 'email' => 'invalid@example.test', 'password' => 'senha']);
    }

    public function test_climate_imports_cannot_duplicate_a_measurement_period(): void
    {
        $source = FonteClimatica::create(['nome' => 'Fonte de teste', 'codigo' => 'TESTE']);
        $point = PontoMonitoramento::create(['fonte_id' => $source->id, 'territorio_id' => $this->territory()->id, 'codigo_externo' => '001', 'nome' => 'Estação', 'latitude' => -16.68, 'longitude' => -49.26]);
        $indicator = IndicadorClimatico::create(['codigo' => 'chuva', 'nome' => 'Chuva', 'unidade' => 'mm', 'agregacao' => 'soma']);
        $values = ['ponto_id' => $point->id, 'indicador_id' => $indicator->id, 'periodo_inicio' => '2026-11-01 00:00:00', 'periodo_fim' => '2026-11-02 00:00:00', 'valor' => 12.5];
        MedicaoClimatica::create($values);
        $this->expectException(QueryException::class);
        MedicaoClimatica::create($values);
    }
}
