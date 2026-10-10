<?php

namespace Database\Factories;

use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    protected $model = Cita::class;

    protected static $lastGeneratedDate;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dentistaId = fake()->numberBetween(2, 4);
        $pacienteId = fake()->numberBetween(5, 20);
        $fecha = $this->generateSequentialDate();
        $hora = fake()->numberBetween(8, 13) . ':00:00';
        $motivoId = fake()->numberBetween(1, 7);
        $estadoId = 1;
        $comentario = null;
        return [
            'dentista_id' => $dentistaId,
            'paciente_id' => $pacienteId,
            'fecha' => $fecha,
            'hora' => $hora,
            'motivo_id' => $motivoId,
            'estado_id' => $estadoId,
            'comentario' => $comentario,
        ];
    }

    private function generateSequentialDate(): string
    {
        $date = static::$lastGeneratedDate ?? Carbon::now()->addDay();
        do {
            $date->addDay();
        } while ($date->isWeekend());
        static::$lastGeneratedDate = $date;
        return $date->toDateString();
    }
}
