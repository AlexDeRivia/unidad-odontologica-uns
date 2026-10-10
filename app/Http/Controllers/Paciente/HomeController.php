<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('app.paciente.home');
    }
    public function miCuenta()
    {
        return view('app.paciente.micuenta');
    }
}
