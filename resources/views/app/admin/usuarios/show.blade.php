@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('admin.usuarios') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="post">

                @csrf
                @method('delete')

                <div class="card my-3">
                    <div class="card-header">Eliminar usuario</div>
                    <div class="card-body">
                        <p>El siguiente usuario será eliminado definitivamente:</p>
                        <input type="hidden" name="id" value="6">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <td>{{ $usuario->usuario_id }}</td>
                            </tr>
                            <tr>
                                <th>DNI</th>
                                <td>{{ $usuario->dni }}</td>
                            </tr>
                            <tr>
                                <th>Correo</th>
                                <td>{{ $usuario->correo }}</td>
                            </tr>
                            <tr>
                                <th>Nombres</th>
                                <td>{{ $usuario->nombres . ' ' . $usuario->apellidos }}</td>
                            </tr>
                            <!--
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ $usuario->usuario_id }}</th>
                                    <td>{{ $usuario->dni }}</td>
                                    <td>{{ $usuario->nombres }}</td>
                                    <td>{{ $usuario->apellidos }}</td>
                                </tr>
                            </tbody>
                            -->
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.usuarios') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection