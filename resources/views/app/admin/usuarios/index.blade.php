@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="btn btn-primary" href="{{ route('admin.usuarios.create') }}">
            <i class="fa-solid fa-file-circle-plus me-2"></i> Insertar
        </a>
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Usuarios</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Nacimiento</th>
                        <th>Dirección</th>
                        <th>Celular</th>
                        <th>Sexo</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Nacimiento</th>
                        <th>Dirección</th>
                        <th>Celular</th>
                        <th>Sexo</th>
                        <th>Rol</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>
                            <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn btn-sm-option btn-primary p-1 px-2">
                                <i class="me-2 fa-solid fa-pen-to-square"></i>Editar
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.usuarios.show', $usuario) }}" class="btn btn-md-option btn-danger p-1 px-2">
                                <i class="me-2 fa-solid fa-trash"></i>Eliminar
                            </a>
                        </td>
                        <td><span>{{ $usuario->usuario_id }}</span></td>
                        <td><span class="field-md">{{ $usuario->correo }}</span></td>
                        <td><span class="field-sm">{{ $usuario->dni }}</span></td>
                        <td><span class="field-md">{{ $usuario->nombres }}</span></td>
                        <td><span class="field-md">{{ $usuario->apellidos }}</span></td>
                        <td><span>{{ $usuario->fech_nac }}</span></td>
                        <td><span class="field-xl">{{ $usuario->direccion }}</span></td>
                        <td><span class="field-md">{{ $usuario->celular }}</span></td>
                        <td><span>{{ $usuario->sexo->descripcion }}</span></td>
                        <td><span>{{ $usuario->rol->descripcion }}</span></td>

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
