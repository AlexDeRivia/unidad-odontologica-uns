<?php

namespace App\Http\Controllers\Dentista;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dentista_id = auth('usuarios')->user()->usuario_id;
        $citas = Cita::where('dentista_id', '=', $dentista_id)
            ->with('paciente', 'motivo', 'estado')
            ->orderBy('estado_id', 'asc')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();
        return view('app.dentista.citas.index', compact('citas'));
    }

    public function atender(Request $request, Cita $cita)
    {
        abort_unless(
            (int) $cita->dentista_id === (int) auth('usuarios')->user()->usuario_id
                && (int) $cita->estado_id === 1,
            403
        );

        $cita->comentario_dentista = $request->comentario_dentista;
        $cita->estado_id = 2;
        $cita->save();
        return redirect()->route('dentista.citas');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        $dentista_id = auth('usuarios')->user()->usuario_id;
        if ($cita->dentista_id == $dentista_id && $cita->estado_id == 1) {
            return view('app.dentista.citas.show', compact('cita'));
        }
        return redirect()->route('dentista.citas');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        //
    }
}
