@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('admin.motivos') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.motivos.destroy', $motivo) }}" method="post">

                @csrf
                @method('delete')

                <div class="card my-3">
                    <div class="card-header">Eliminar motivo</div>
                    <div class="card-body">
                        <p>El siguiente motivo será eliminado definitivamente:</p>
                        <input type="hidden" name="id" value="6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Motivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ $motivo->motivo_id }}</th>
                                    <td>{{ $motivo->descripcion }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.motivos') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection