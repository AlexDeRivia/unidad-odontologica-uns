<?php

namespace Database\Seeders;

use App\Models\Sexo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sexos = [
            ['descripcion' => 'Masculino'],
            ['descripcion' => 'Femenino'],
            ['descripcion' => 'No binario'],
            ['descripcion' => 'Otros'],
            ['descripcion' => 'Prefiero no decirlo'],
        ];

        foreach ($sexos as $sexo) {
            Sexo::create($sexo);
        }
    }
}
