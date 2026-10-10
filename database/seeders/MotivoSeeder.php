<?php

namespace Database\Seeders;

use App\Models\Motivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motivos = [
            ['descripcion' => 'Consulta de rutina'],
            ['descripcion' => 'Tamizaje oral'],
            ['descripcion' => 'Limpieza dental'],
            ['descripcion' => 'Blanqueamiento dental'],
            ['descripcion' => 'Extracción dental'],
            ['descripcion' => 'Tratamiento de conducto'],
            ['descripcion' => 'Selladores dentales'],
        ];

        foreach ($motivos as $motivo) {
            Motivo::create($motivo);
        }
    }
}
