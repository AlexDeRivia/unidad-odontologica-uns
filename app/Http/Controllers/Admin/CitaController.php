<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('dentista', 'paciente', 'motivo', 'estado')->get();
        return view('app.admin.citas.index', compact('citas'));
    }
}
