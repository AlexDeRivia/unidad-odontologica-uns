<?php

namespace App\Http\Controllers\Paciente;

class Seguridad
{
    public static function validar()
    {
        $user = auth('usuarios')->user();
        if (isset($user)) {
            $rol_id = $user->rol_id;
            switch ($rol_id) {
                case 1:
                    return 'admin.home';
                case 2:
                    return 'dentista.home';
                case 3:
                    break;
            }
        } else {
            return 'login';
        }
        return null;
    }
}