<?php

namespace Tests\Feature;

use App\Models\Cita;
use App\Models\Usuario;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_seed_uses_synthetic_accounts_with_distinct_passwords(): void
    {
        $this->seed(DatabaseSeeder::class);

        $admin = Usuario::findOrFail(1);
        $dentist = Usuario::findOrFail(2);

        $this->assertSame('usuario01@example.test', $admin->correo);
        $this->assertSame(1, (int) $admin->rol_id);
        $this->assertNotSame($admin->contrasena, $dentist->contrasena);
        $this->assertSame(20, Usuario::count());
        $this->assertSame(110, Cita::count());
    }
}
