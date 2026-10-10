<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DentistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dentistas = Usuario::where('rol_id', 2)->with('especialidades')->get();
        return view('app.paciente.dentistas.index', compact('dentistas'));
    }
}
