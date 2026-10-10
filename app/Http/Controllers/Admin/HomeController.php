<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $currentDate = now();
        $threeMonthsAgo = $currentDate->subMonths(12);

        $citasPorMes = Cita::where('estado_id', 2)
            ->whereBetween('fecha', [$threeMonthsAgo, now()])
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->fecha)->format('F - Y');
            })
            ->map(function($item) {
                return $item->count();
            });

        $resultados = DB::table('citas')
            ->select('estado_id', DB::raw('COUNT(*) as conteototal'))
            ->groupBy('estado_id')
            ->get();
        $conteoPorEstado = [];
        foreach ($resultados as $fila) {
            $estadoId = $fila->estado_id;
            $conteoTotal = $fila->conteototal;
            $conteoPorEstado[$estadoId] = $conteoTotal;
        }

        $query = "SELECT u.nombres, u.apellidos, COUNT(c.cita_id) as citas_atendidas
            FROM usuarios u
            JOIN citas c ON u.usuario_id = c.dentista_id
            WHERE c.estado_id = 2
            GROUP BY u.usuario_id, u.nombres, u.apellidos";
        $result = DB::select($query);
        $citasAtendidas = [];
        foreach ($result as $row) {
            $nombreCompleto = $row->nombres . ' ' . $row->apellidos;
            $citasAtendidas[$nombreCompleto] = $row->citas_atendidas;
        }

        return view('app.admin.home', compact('citasPorMes', 'citasAtendidas', 'conteoPorEstado'));
    }
    public function miCuenta()
    {
        return view('app.admin.micuenta');
    }
}
