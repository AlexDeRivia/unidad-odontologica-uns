<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = "especialidades";

    protected $primaryKey = "especialidad_id";

    protected $guarded = [];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'dentistas_especialidades', 'especialidad_id', 'dentista_id');
    }
}
