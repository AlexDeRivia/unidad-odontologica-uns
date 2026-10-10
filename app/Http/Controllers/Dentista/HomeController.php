<?php

namespace App\Http\Controllers\Dentista;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('app.dentista.home');
    }

    public function miCuenta()
    {
        /**
         * VER SESSION
         */
        $usuario = Usuario::with('rol', 'sexo')->find(3);
        return view('app.dentista.micuenta', compact('usuario'));
    }
}
