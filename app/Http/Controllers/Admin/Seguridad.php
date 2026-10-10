<?php

namespace App\Http\Controllers\Admin;

class Seguridad
{
    public static function validar()
    {
        $user = auth('usuarios')->user();
        if (isset($user)) {
            $rol_id = $user->rol_id;
            switch ($rol_id) {
                case 1:
                    break;
                case 2:
                    return 'dentista.home';
                case 3:
                    return 'paciente.home';
            }
        } else {
            return 'login';
        }
        return null;
    }
}
