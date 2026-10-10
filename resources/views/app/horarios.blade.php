@extends('layouts.welcome')

@section('title', 'Unidad Odontológica')

@section('content')
@include('partials.app.carousel')

<div class="container bg-white shadow py-4 py-md-5">

    <div class="mx-0 mx-lg-5 px-0 px-sm-3" id="horarios">

        <h2 class="text-danger mb-4">Horario de la Clínica Dental</h2>

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Día</th>
                    <th scope="col">Hora de inicio</th>
                    <th scope="col">Hora de cierre</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lunes a Viernes</td>
                    <td>8:00 AM</td>
                    <td>2:00 PM</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection