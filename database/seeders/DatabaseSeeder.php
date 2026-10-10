<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cita;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(SexoSeeder::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(MotivoSeeder::class);
        $this->call(UsuarioSeeder::class);
        Usuario::factory()->count(12)->create();
        $this->call(CitaSeeder::class);
        Cita::factory()->count(50)->create();
    }
}
