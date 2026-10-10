<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Create clearly synthetic accounts for a local demonstration.
     * Passwords are random and are never published or logged.
     */
    public function run(): void
    {
        $roles = [1, 2, 2, 2, 3, 3, 3, 3];

        foreach ($roles as $index => $rolId) {
            $number = $index + 1;
            $label = match ($rolId) {
                1 => 'Administrador',
                2 => 'Dentista',
                default => 'Paciente',
            };

            Usuario::create([
                'usuario_id' => $number,
                'correo' => sprintf('usuario%02d@example.test', $number),
                'contrasena' => Str::random(48),
                'dni' => sprintf('%08d', $number),
                'nombres' => $label,
                'apellidos' => sprintf('Ejemplo %02d', $number),
                'fech_nac' => '1990-01-01',
                'direccion' => 'Dirección ficticia para demostración',
                'celular' => sprintf('%09d', $number),
                'foto' => null,
                'sexo_id' => 5,
                'rol_id' => $rolId,
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ]);
        }
    }
}
