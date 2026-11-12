<?php

namespace Tests\Feature;

use App\Models\AcessoTerritorial;
use App\Models\Pessoa;
use App\Models\Territorio;
use App\Models\TerritorioHierarquia;
use App\Models\Usuario;
use App\Models\VinculoOrganizacional;
use Database\Seeders\LoginSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_five_accounts_and_only_managers_receive_grants(): void
    {
        $this->seed(LoginSeeder::class);
        $this->seed(LoginSeeder::class);
        $this->assertSame(5, Usuario::count());
        $this->assertSame(5, Pessoa::count());
        $this->assertSame(2, VinculoOrganizacional::count());
        $this->assertSame(2, AcessoTerritorial::count());
        $this->assertSame(10, TerritorioHierarquia::count());
        foreach (Usuario::all() as $user) {
            $this->assertTrue(Hash::check(LoginSeeder::DEFAULT_PASSWORD, $user->password));
            $this->assertSame('ativo', $user->status);
            $this->assertSame(str_starts_with($user->email, 'gestor'), $user->vinculosOrganizacionais()->exists());
        }
        foreach (AcessoTerritorial::with('papel.permissoes', 'territorio')->get() as $grant) {
            $this->assertSame('gestor', $grant->papel->codigo);
            $this->assertCount(4, $grant->papel->permissoes);
            $this->assertTrue($grant->inclui_descendentes);
            $this->assertNull($grant->revogado_em);
            $this->assertSame('CLIMA:BR:DF:BRASILIA', $grant->territorio->codigo_oficial);
        }
        $country = Territorio::where('codigo_oficial', 'CLIMA:BR')->firstOrFail();
        $this->assertSame(4, $country->descendentes()->count());
    }

    public function test_rerunning_preserves_an_existing_password(): void
    {
        $this->seed(LoginSeeder::class);
        $user = Usuario::where('email', 'usuario1@climanapele.test')->firstOrFail();
        $user->update(['password' => 'SenhaAlterada@2026']);
        $this->seed(LoginSeeder::class);
        $this->assertTrue(Hash::check('SenhaAlterada@2026', $user->fresh()->password));
    }
}
