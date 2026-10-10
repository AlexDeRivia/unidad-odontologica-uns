<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Motivo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paciente_id = auth('usuarios')->user()->usuario_id;
        $citas = Cita::where('paciente_id', '=', $paciente_id)
            ->with('dentista', 'motivo', 'estado')
            ->orderBy('estado_id', 'asc')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();
        return view('app.paciente.citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dentistas = Usuario::where('rol_id', 2)->get();
        $motivos = Motivo::all();
        return view('app.paciente.citas.reservar', compact('dentistas', 'motivos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dentista_id = $request->dentista_id;
        $paciente_id = auth('usuarios')->user()->usuario_id;
        $fecha = $request->fecha;
        $hora = $request->hora;
        $motivo_id = $request->motivo_id;
        $estado_id = 1;
        $comentario = $request->comentario;

        $errores = [];

        if (Servicio::yaEstasHoy($paciente_id, $fecha)) {
            $errores[] = "Ya es reservado una cita para ese día, prueba un día diferente";
        }
        if (!Servicio::aTiempo($fecha)) {
            $errores[] = "Debe reservar su cita con al menos un día de antelación";
        }
        if (!Servicio::esLaborable($fecha)) {
            $errores[] = "Debe reservar su cita en días laborables (Lunes a Viernes)";
        }
        if (Servicio::estaOcupado($fecha, $hora)) {
            $errores[] = "La fecha y hora seleccionadas ya están reservadas";
        }

        if (!empty($errores)) {
            return back()->withErrors($errores)->withInput();
        }

        $cita = new Cita();
        $cita->dentista_id = $dentista_id;
        $cita->paciente_id = $paciente_id;
        $cita->fecha = $fecha;
        $cita->hora = $hora;
        $cita->motivo_id = $motivo_id;
        $cita->estado_id = $estado_id;
        $cita->comentario = $comentario;

        $cita->save();
        return redirect()->route('paciente.citas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        $estado_id = $cita->estado_id;
        $paciente_id = $cita->paciente_id;
        $usuario_id = auth('usuarios')->user()->usuario_id;
        if ($estado_id == 1 && $paciente_id == $usuario_id) {
            return view('app.paciente.citas.show', compact('cita'));
        }
        return redirect()->route('paciente.citas');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        $estado_id = $cita->estado_id;
        $paciente_id = $cita->paciente_id;
        $usuario_id = auth('usuarios')->user()->usuario_id;
        if ($estado_id == 1 && $paciente_id == $usuario_id) {
            $dentistas = Usuario::where('rol_id', 2)->get();
            $motivos = Motivo::all();
            return view('app.paciente.citas.reprogramar', compact('cita', 'dentistas', 'motivos'));
        }
        return redirect()->route('paciente.citas');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        abort_unless(
            (int) $cita->paciente_id === (int) auth('usuarios')->user()->usuario_id
                && (int) $cita->estado_id === 1,
            403
        );

        $dentista_id = $request->dentista_id;
        $paciente_id = auth('usuarios')->user()->usuario_id;
        $fecha = $request->fecha;
        $hora = $request->hora;
        $motivo_id = $request->motivo_id;
        $comentario = $request->comentario;

        $errores = [];

        if (Servicio::yaEstasHoy($paciente_id, $fecha, (int) $cita->cita_id)) {
            $errores[] = "Ya es reservado una cita para ese día, prueba un día diferente";
        }
        if (!Servicio::aTiempo($fecha)) {
            $errores[] = "Debe reservar su cita con al menos un día de antelación";
        }
        if (!Servicio::esLaborable($fecha)) {
            $errores[] = "Debe reservar su cita en días laborables (Lunes a Viernes)";
        }
        if (Servicio::estaOcupado($fecha, $hora, (int) $cita->cita_id)) {
            $errores[] = "Debe seleccionar una fecha y horas distintas para concretar la reprogramación";
        }

        if (!empty($errores)) {
            return back()->withErrors($errores)->withInput();
        }

        $cita->dentista_id = $dentista_id;
        $cita->fecha = $fecha;
        $cita->hora = $hora;
        $cita->motivo_id = $motivo_id;
        $cita->comentario = $comentario;

        $cita->save();
        return redirect()->route('paciente.citas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancel(Cita $cita)
    {
        abort_unless(
            (int) $cita->paciente_id === (int) auth('usuarios')->user()->usuario_id
                && (int) $cita->estado_id === 1,
            403
        );

        $cita->estado_id = 3;
        $cita->save();
        return redirect()->route('paciente.citas');
    }
}
