<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motivo;
use Illuminate\Http\Request;

class MotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motivos = Motivo::all();
        return view('app.admin.motivos.index', compact('motivos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.motivos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'motivo_id' => "required|numeric|unique:motivos,motivo_id",
            'descripcion' => "required|unique:motivos,descripcion"
        ]);
        $motivo = Motivo::create($request->all());
        return redirect()->route('admin.motivos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motivo $motivo)
    {
        return view('app.admin.motivos.show', compact('motivo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motivo $motivo)
    {
        return view('app.admin.motivos.edit', compact('motivo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motivo $motivo)
    {
        $request->validate([
            'descripcion' => "required|unique:motivos,descripcion,$motivo->motivo_id,motivo_id"
        ]);
        $motivo->update($request->all());
        return redirect()->route('admin.motivos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motivo $motivo)
    {
        $motivo->delete();
        return redirect()->route('admin.motivos');
    }
}
