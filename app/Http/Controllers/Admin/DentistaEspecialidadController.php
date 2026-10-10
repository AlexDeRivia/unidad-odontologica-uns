<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DentistaEspecialidad;
use App\Models\Especialidad;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DentistaEspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dentistas = Usuario::where('rol_id', 2)->with('especialidades')->get();
        return view('app.admin.especialidades-asignar.index', compact('dentistas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $dentista)
    {
        if ($dentista->rol_id == 2) {
            $especialidades = Especialidad::all();
            return view('app.admin.especialidades-asignar.show', compact('dentista', 'especialidades'));
        } else {
            return redirect()->route('admin.especialidad-asignar');
        }
    }

    public function process(Request $request)
    {
        $dentista_id = $request->input('dentista_id');
        $especialidades_seleccionadas = $request->input('especialidades');

        // Obtener las especialidades actuales del dentista
        $especialidades_actuales = DentistaEspecialidad::where('dentista_id', $dentista_id)
            ->pluck('especialidad_id')
            ->toArray();

        // Identificar las especialidades que se deben eliminar
        $especialidades_eliminar = is_array($especialidades_seleccionadas)
            ? array_diff($especialidades_actuales, $especialidades_seleccionadas)
            : $especialidades_actuales;

        // Identificar las especialidades que se deben agregar
        $especialidades_agregar = is_array($especialidades_seleccionadas)
            ? array_diff($especialidades_seleccionadas, $especialidades_actuales)
            : [];

        // Eliminar las especialidades que ya no están seleccionadas
        if (!empty($especialidades_eliminar)) {
            DentistaEspecialidad::where('dentista_id', $dentista_id)
                ->whereIn('especialidad_id', $especialidades_eliminar)
                ->delete();
        }

        // Agregar las nuevas especialidades seleccionadas
        foreach ($especialidades_agregar as $especialidad_id) {
            DentistaEspecialidad::create([
                'dentista_id' => $dentista_id,
                'especialidad_id' => $especialidad_id,
            ]);
        }

        return redirect()->route('admin.especialidad-asignar');
    }
}
