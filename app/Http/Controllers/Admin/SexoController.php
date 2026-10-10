<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sexo;
use Illuminate\Http\Request;

class SexoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sexos = Sexo::all();
        return view('app.admin.sexos.index', compact('sexos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.sexos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sexo_id' => "required|numeric|unique:sexos,sexo_id",
            'descripcion' => "required|unique:sexos,descripcion"
        ]);
        $sexo = Sexo::create($request->all());
        return redirect()->route('admin.sexos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sexo $sexo)
    {
        return view('app.admin.sexos.show', compact('sexo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sexo $sexo)
    {
        return view('app.admin.sexos.edit', compact('sexo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sexo $sexo)
    {
        $request->validate([
            'descripcion' => "required|unique:sexos,descripcion,$sexo->sexo_id,sexo_id"
        ]);
        $sexo->update($request->all());
        return redirect()->route('admin.sexos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sexo $sexo)
    {
        $sexo->delete();
        return redirect()->route('admin.sexos');
    }
}
