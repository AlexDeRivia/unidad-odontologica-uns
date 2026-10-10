<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory,  Notifiable;

    protected $table = "usuarios";

    protected $primaryKey = "usuario_id";

    protected $guarded = [];

    protected $password = 'contrasena';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contrasena',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'contrasena' => 'hashed'
    ];

    public function getAuthIdentifierName()
    {
        return 'correo';
    }

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'dentistas_especialidades', 'dentista_id', 'especialidad_id');
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'sexo_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
