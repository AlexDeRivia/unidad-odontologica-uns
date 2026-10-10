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

        <div class="col-lg-10 offset-lg-1">

            <form action="{{ route('admin.usuarios.update', $usuario) }}" method="post" class="needs-validation" novalidate>

                @csrf
                @method('put')

                <div class="card my-3">
                    <div class="card-header">Editar Usuario</div>
                    @error('usuario_id') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    @error('correo') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    @error('dni') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    @error('celular') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    <div class="card-body">
                        <div class="row text-lg-end">
                            <div class="col-lg-2">
                                <label for="usuario_id" class="form-label">ID</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('usuario_id', $usuario->usuario_id) }}" type="text" class="form-control" id="usuario_id" disabled>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                        <div class="row text-lg-end">
                            <div class="col-lg-2">
                                <label for="correo" class="form-label">Correo</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('correo', $usuario->correo) }}" type="email" class="form-control" id="correo" name="correo" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="dni" class="form-label">DNI</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('dni', $usuario->dni) }}" type="text" class="form-control" id="dni" name="dni" minlength="8" maxlength="8" required>
                                <div class="invalid-feedback">El DNI es de 8 dígitos</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="nombres" class="form-label">Nombres</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('nombres', $usuario->nombres) }}" type="text" class="form-control" id="nombres" name="nombres" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="apellidos" class="form-label">Apellidos</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('apellidos', $usuario->apellidos) }}" type="text" class="form-control" id="apellidos" name="apellidos" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="fech_nac" class="form-label">Nacimiento</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('fech_nac', $usuario->fech_nac) }}" type="date" class="form-control" id="fech_nac" name="fech_nac" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="direccion" class="form-label">Dirección</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('direccion', $usuario->direccion) }}" type="text" class="form-control" id="direccion" name="direccion" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="celular" class="form-label">Celular</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('celular', $usuario->celular) }}" type="text" class="form-control" id="celular" name="celular" minlength="9" maxlength="9" required>
                                <div class="invalid-feedback">Ingrese un número de celular válido</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="sexo_id" class="form-label">Sexo</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <select class="form-select" name="sexo_id" id="sexo_id" required>
                                    <option></option>
                                    @foreach ($sexos as $sexo)
                                    <option value="{{ $sexo->sexo_id }}" {{ old('sexo_id', $usuario->sexo_id) == $sexo->sexo_id ? 'selected' : '' }}>{{ $sexo->descripcion }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="rol_id" class="form-label">Rol</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <select class="form-select" name="rol_id" id="rol_id" required>
                                    <option></option>
                                    @foreach ($roles as $rol)
                                    <option value="{{ $rol->rol_id }}" {{ old('rol_id', $usuario->rol_id) == $rol->rol_id ? 'selected' : '' }}>{{ $rol->descripcion }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.usuarios') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
