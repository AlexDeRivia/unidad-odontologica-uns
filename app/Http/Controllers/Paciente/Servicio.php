<?php

namespace App\Http\Controllers\Paciente;

use App\Models\Cita;

class Servicio
{
    /**
     * Verifica que solo pueda reservar 1 cita al día
     */
    public static function yaEstasHoy($paciente_id, $fecha, ?int $exceptoCitaId = null)
    {
        $query = Cita::where('fecha', $fecha)
            ->where('paciente_id', $paciente_id)
            ->where('estado_id', 1);
        if ($exceptoCitaId !== null) {
            $query->where('cita_id', '!=', $exceptoCitaId);
        }
        return $query->exists();
    }

    /**
     * Verifica si la Fecha y Hora ya están Reservados
     */
    public static function estaOcupado($fecha, $hora, ?int $exceptoCitaId = null)
    {
        $query = Cita::where('fecha', $fecha)
            ->where('hora', $hora)
            ->where('estado_id', '!=', 3);
        if ($exceptoCitaId !== null) {
            $query->where('cita_id', '!=', $exceptoCitaId);
        }
        return $query->exists();
    }

    /**
     * Verifica que este en un plazo de 1 día de anticipación
     */
    public static function aTiempo($fecha)
    {
        $fechaActual = time();
        $timestampFecha = strtotime($fecha);
        return $timestampFecha > $fechaActual;
    }

    /**
     * Verifica que sea fecha laborable
     */
    public static function esLaborable($fecha)
    {
        $numeroDiaSemana = date('w', strtotime($fecha));
        return ($numeroDiaSemana >= 1 && $numeroDiaSemana <= 5);
    }
}
