@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="btn btn-primary" href="{{ route('admin.sexos.create') }}">
            <i class="fa-solid fa-file-circle-plus me-2"></i> Insertar
        </a>
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Sexos</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>ID</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>ID</th>
                        <th>Descripción</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($sexos as $sexo)
                    <tr>
                        <td>
                            <a href="{{ route('admin.sexos.edit', $sexo) }}" class="btn btn-sm-option btn-primary p-1 px-2">
                                <i class="me-2 fa-solid fa-pen-to-square"></i>Editar
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.sexos.show', $sexo) }}" class="btn btn-md-option btn-danger p-1 px-2">
                                <i class="me-2 fa-solid fa-trash"></i>Eliminar
                            </a>
                        </td>
                        <td>{{ $sexo->sexo_id }}</td>
                        <td>{{ $sexo->descripcion }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('dist/js/datatables.js') }}"></script>
<script src="{{ asset('dist/js/mitable.js') }}"></script>

@endsection