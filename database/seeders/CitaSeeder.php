<?php

namespace Database\Seeders;

use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    protected static $lastGeneratedDate;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 60; $i++) {
            $cita = [
                'dentista_id' => fake()->numberBetween(2, 4),
                'paciente_id' => fake()->numberBetween(5, 20),
                'fecha' => $this->generateSequentialDate(),
                'hora' => fake()->numberBetween(8, 13) . ':00:00',
                'motivo_id' => fake()->numberBetween(1, 7),
                'estado_id' => fake()->randomElement([2,2,3]),
                'comentario' => null
            ];
            Cita::create($cita);
        }
    }

    private function generateSequentialDate(): string
    {
        $date = static::$lastGeneratedDate ?? Carbon::parse('2023-09-25')->addDay();
        do {
            $date->addDay();
        } while ($date->isWeekend());
        static::$lastGeneratedDate = $date;
        return $date->toDateString();
    }
}
