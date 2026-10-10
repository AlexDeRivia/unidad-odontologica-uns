<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidades = [
            ['descripcion' => 'Ortodoncia'],
            ['descripcion' => 'Periodoncia'],
            ['descripcion' => 'Endodoncia'],
            ['descripcion' => 'Cirugía Oral'],
            ['descripcion' => 'Odontopediatría'],
            ['descripcion' => 'Implantología'],
            ['descripcion' => 'Odontología Estética'],
            ['descripcion' => 'Ortopedia Maxilar'],
            ['descripcion' => 'Cirugía Maxilofacial'],
            ['descripcion' => 'Prostodoncia'],
        ];

        foreach ($especialidades as $especialidad) {
            Especialidad::create($especialidad);
        }
    }
}
