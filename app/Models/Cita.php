<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = "citas";

    protected $primaryKey = "cita_id";

    protected $guarded = [];

    public function dentista()
    {
        return $this->belongsTo(Usuario::class, 'dentista_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Usuario::class, 'paciente_id');
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class, 'motivo_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
