<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Sexo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    public function home()
    {
        return view('app.home');
    }

    public function nosotros()
    {
        $dentistas = Usuario::where('rol_id', 2)->with('especialidades')->get();
        $especialidades = Especialidad::all();
        return view('app.nosotros', compact('dentistas', 'especialidades'));
    }

    public function horarios()
    {
        return view('app.horarios');
    }

    public function register()
    {
        $sexos = Sexo::all();
        return view('app.register', compact('sexos'));
    }

    public function login()
    {
        return view('app.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'correo' => 'required|email|max:255|unique:usuarios,correo',
            'contrasena' => ['required', 'string', Password::min(12)->letters()->numbers()],
            'dni' => 'required|digits:8|unique:usuarios,dni',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fech_nac' => 'required|date|before:today',
            'direccion' => 'required|string|max:255',
            'celular' => 'required|digits:9',
            'sexo_id' => 'required|exists:sexos,sexo_id',
        ]);

        Usuario::create([...$validated, 'rol_id' => 3]);
        return view('app.message')->with('message', "Su cuenta fue creada satisfactoriamente");
    }
}
