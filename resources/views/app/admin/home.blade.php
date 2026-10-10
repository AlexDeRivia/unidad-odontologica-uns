@php
    $usuario = auth('usuarios')->user();
@endphp

@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<div class="container mb-3">

    <h5 class="py-3 mb-3 border-bottom">
        ¡Bienvenido {{ $usuario->nombres . ' ' . $usuario->apellidos }}!
    </h5>

    <div class="row">
        @component('components.cardbutton')
            @slot('type', 'primary')
            @slot('section', 'Usuarios')
            @slot('route', 'admin.usuarios')
        @endcomponent
        @component('components.cardbutton')
            @slot('type', 'warning')
            @slot('section', 'Citas')
            @slot('route', 'admin.citas')
        @endcomponent
        @component('components.cardbutton')
            @slot('type', 'success')
            @slot('section', 'Especialidades')
            @slot('route', 'admin.especialidades')
        @endcomponent
        @component('components.cardbutton')
            @slot('type', 'secondary')
            @slot('section', 'Asignación de Especialidades')
            @slot('route', 'admin.especialidad-asignar')
        @endcomponent
        @component('components.cardbutton')
            @slot('type', 'danger')
            @slot('section', 'Motivos')
            @slot('route', 'admin.motivos')
        @endcomponent
        @component('components.cardbutton')
            @slot('type', 'info')
            @slot('section', 'Sexos')
            @slot('route', 'admin.sexos')
        @endcomponent
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Tendencia de Citas Atendidas
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                <div class="card-footer">
                    Este gráfico solo representa el total de citas <span class="text-success">atendidad</span>, para ver la información de citas <span class="text-secondary">pendientes</span> o <span class="text-danger">canceladas</span> visite el <a href="{{ route('admin.citas') }}">registro</a>.
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Total de citas Atendidas por Dentista
                </div>
                <div class="card-body"><canvas id="barDentistas" width="100%" height="40"></canvas></div>
                <div class="card-footer">
                    Este gráfico solo representa a los dentistas que hayan <span class="text-success">atendido</span> alguna cita en este sistema, si solo tienen citas <span class="text-secondary">pendientes</span> o <span class="text-danger">canceladas</span> no aparecerán aquí.
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Total de citas por Estado
                </div>
                <div class="card-body"><canvas id="barCitas" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('dist/js/chart.js') }}"></script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {{ Illuminate\Support\Js::from($citasPorMes->keys()->all()) }},
            datasets: [{
                label: "Citas",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: {{ Illuminate\Support\Js::from($citasPorMes->values()->all()) }},
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 5,
                        stepSize: 1
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
</script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var ctx = document.getElementById("barDentistas");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {{ Illuminate\Support\Js::from(array_keys($citasAtendidas)) }},
            datasets: [{
                label: "Citas",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: {{ Illuminate\Support\Js::from(array_values($citasAtendidas)) }},
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 5,
                        stepSize: 1
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
</script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var ctx = document.getElementById("barCitas");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Pendientes", "Atendidas", "Canceladas"],
            datasets: [{
                label: "Citas",
                backgroundColor: ["rgba(108, 117, 125, 1)", "rgba(2, 117, 216, 1)", "rgba(220, 53, 69, 1)"],
                borderColor: ["rgba(108, 117, 125, 1)", "rgba(0, 123, 255, 1)", "rgba(220, 53, 69, 1)"],
                data: [@foreach ($conteoPorEstado as $c) {{ $c . ', ' }} @endforeach],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 5,
                        stepSize: 1
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
</script>

@endsection
