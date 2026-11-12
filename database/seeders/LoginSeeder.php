<?php

namespace Database\Seeders;

use App\Models\AcessoTerritorial;
use App\Models\Organizacao;
use App\Models\OrganizacaoTerritorio;
use App\Models\Papel;
use App\Models\Permissao;
use App\Models\Pessoa;
use App\Models\Territorio;
use App\Models\TerritorioHierarquia;
use App\Models\Usuario;
use App\Models\VinculoOrganizacional;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class LoginSeeder extends Seeder
{
    public const DEFAULT_PASSWORD = 'Clima@2026!';

    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            throw new RuntimeException('LoginSeeder cria contas de demonstracao apenas em local ou testing.');
        }

        DB::transaction(function (): void {
            foreach (range(1, 3) as $number) {
                $this->createAccount("usuario{$number}@climanapele.test", "Usuario {$number}");
            }
            $managers = [];
            foreach (range(1, 2) as $number) {
                $managers[] = $this->createAccount("gestor{$number}@climanapele.test", "Gestor {$number}");
            }

            $territory = $this->createTerritories();
            $organization = Organizacao::firstOrCreate([
                'nome' => 'Administracao de Brasilia - Demonstracao',
                'territorio_sede_id' => $territory->id,
            ], ['sigla' => 'DEMO-DF', 'tipo' => 'publica']);
            OrganizacaoTerritorio::firstOrCreate([
                'organizacao_id' => $organization->id, 'territorio_id' => $territory->id,
            ], ['inclui_descendentes' => true]);

            $role = Papel::firstOrCreate(['codigo' => 'gestor'], ['nome' => 'Gestor territorial']);
            foreach ([
                'ocorrencias.visualizar' => 'Consultar ocorrencias do territorio',
                'ocorrencias.moderar' => 'Moderar ocorrencias do territorio',
                'acoes.gerenciar' => 'Gerenciar acoes publicas do territorio',
                'indicadores.visualizar' => 'Consultar indicadores do territorio',
            ] as $code => $description) {
                $permission = Permissao::firstOrCreate(['codigo' => $code], ['descricao' => $description]);
                $role->permissoes()->syncWithoutDetaching([$permission->id]);
            }

            foreach ($managers as $manager) {
                $membership = VinculoOrganizacional::firstOrCreate([
                    'usuario_id' => $manager->id, 'organizacao_id' => $organization->id,
                ], ['cargo' => 'Gestor territorial', 'iniciado_em' => now()]);
                // Bootstrap grant: the first demo manager is the granting actor.
                AcessoTerritorial::firstOrCreate([
                    'vinculo_id' => $membership->id, 'papel_id' => $role->id, 'territorio_id' => $territory->id,
                ], ['concedido_por_id' => $managers[0]->id, 'inclui_descendentes' => true]);
            }
        });
    }

    private function createAccount(string $email, string $name): Usuario
    {
        if ($existing = Usuario::where('email', $email)->first()) {
            return $existing;
        }
        $person = Pessoa::create(['nome' => $name]);

        // The Usuario model hashes the password through its hashed cast.
        return Usuario::create([
            'pessoa_id' => $person->id, 'email' => $email,
            'password' => self::DEFAULT_PASSWORD, 'status' => 'ativo',
        ]);
    }

    private function createTerritories(): Territorio
    {
        $ancestors = [];
        $parent = null;
        foreach ([
            ['CLIMA:BR', 'Brasil', 'pais'],
            ['CLIMA:BR:CO', 'Centro-Oeste', 'regiao'],
            ['CLIMA:BR:DF', 'Distrito Federal', 'estado'],
            ['CLIMA:BR:DF:BRASILIA', 'Brasilia', 'regiao_administrativa'],
        ] as [$code, $name, $type]) {
            // Internal identifiers, not official IBGE codes.
            $territory = Territorio::firstOrCreate(['codigo_oficial' => $code], [
                'nome' => $name, 'tipo' => $type, 'pai_id' => $parent?->id,
            ]);
            $ancestors[] = $territory;
            foreach ($ancestors as $index => $ancestor) {
                TerritorioHierarquia::firstOrCreate([
                    'ancestral_id' => $ancestor->id, 'descendente_id' => $territory->id,
                ], ['profundidade' => count($ancestors) - 1 - $index]);
            }
            $parent = $territory;
        }

        return $parent;
    }
}
