<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\Sexo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('sexo', 'rol')->where('rol_id', '!=', 1)->get();
        return view('app.admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::where('rol_id', '!=', 1)->get();
        $sexos = Sexo::all();
        return view('app.admin.usuarios.create', compact('roles', 'sexos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|integer|unique:usuarios,usuario_id',
            'correo' => 'required|email|max:255|unique:usuarios,correo',
            'contrasena' => ['required', 'string', Password::min(12)->letters()->numbers()],
            'dni' => 'required|digits:8|unique:usuarios,dni',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fech_nac' => 'required|date|before:today',
            'direccion' => 'required|string|max:255',
            'celular' => 'required|digits:9',
            'sexo_id' => 'required|exists:sexos,sexo_id',
            'rol_id' => 'required|in:2,3',
        ]);
        Usuario::create($validated);
        return redirect()->route('admin.usuarios');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        if($usuario->rol_id != 1) {
            return view('app.admin.usuarios.show', compact('usuario'));
        } else {
            return redirect()->route('admin.usuarios');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        if ($usuario->rol_id != 1) {
            $roles = Rol::where('rol_id', '!=', 1)->get();
            $sexos = Sexo::all();
            return view('app.admin.usuarios.edit', compact('usuario', 'roles', 'sexos'));
        } else {
            return redirect()->route('admin.usuarios');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        abort_if((int) $usuario->rol_id === 1, 403);

        $validated = $request->validate([
            'correo' => "required|email|max:255|unique:usuarios,correo,$usuario->usuario_id,usuario_id",
            'dni' => "required|digits:8|unique:usuarios,dni,$usuario->usuario_id,usuario_id",
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fech_nac' => 'required|date|before:today',
            'direccion' => 'required|string|max:255',
            'celular' => 'required|digits:9',
            'sexo_id' => 'required|exists:sexos,sexo_id',
            'rol_id' => 'required|in:2,3',
        ]);
        $usuario->update($validated);
        return redirect()->route('admin.usuarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        abort_if((int) $usuario->rol_id === 1, 403);

        $usuario->delete();
        return redirect()->route('admin.usuarios');
    }
}
