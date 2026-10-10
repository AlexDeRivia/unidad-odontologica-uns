<?php

namespace App\Http\Controllers\Dentista;

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
                    break;
                case 3:
                    return 'paciente.home';
            }
        } else {
            return 'login';
        }
        return null;
    }
}