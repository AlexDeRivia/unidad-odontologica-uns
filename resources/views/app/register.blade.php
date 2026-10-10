@extends('layouts.welcome')

@section('title', 'Unidad Odontológica')

@section('content')
<div class="container py-lg-5 py-3">

    <div class="row">

        <div class="col-lg-8 offset-lg-2">

            <div class="card shadow">

                <div class="card-header bg-uns">
                    <a href="{{ route('home') }}">
                        <span class="uo-brand d-inline-block my-3">UNS <small>· Unidad Odontológica</small></span>
                    </a>
                </div>

                <form method="post" action="{{ route('register.store') }}" id="clearForm" class="needs-validation" novalidate>

                    @csrf

                    @error('correo') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    @error('dni') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    @error('celular') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    <div class="card-body">
                        <h6>Datos de registro</h6>
                        <hr>
                        <div class="row text-start text-lg-end align-items-start">
                            <div class="col-lg-2">
                                <label for="correo" class="form-label">Correo</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('correo') }}" type="email" class="form-control" id="correo" name="correo" required>
                                <div class="invalid-feedback">Ingrese un correo electrónico válido</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="contrasena" class="form-label">Contraseña</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="password" class="form-control" id="contrasena" name="contrasena" minlength="12" autocomplete="new-password" required>
                                <div class="invalid-feedback">Usa al menos 12 caracteres, con letras y números</div>
                            </div>
                        </div>
                        <h6>Datos personales</h6>
                        <hr>
                        <div class="row text-start text-lg-end align-items-start">
                            <div class="col-lg-2">
                                <label for="dni" class="form-label">DNI</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('dni') }}" type="text" class="form-control custom-validation" id="dni" name="dni" minlength="8" maxlength="8" required>
                                <div class="invalid-feedback">El DNI debe ser de 8 dígitos</div>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-2">
                                <label for="nombres" class="form-label">Nombres</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('nombres') }}" type="text" class="form-control" id="nombres" name="nombres" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="apellidos" class="form-label">Apellidos</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('apellidos') }}" type="text" class="form-control" id="apellidos" name="apellidos" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="fech_nac" class="form-label">Nacimiento</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('fech_nac') }}" type="date" class="form-control" id="fech_nac" name="fech_nac" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="direccion" class="form-label">Direccion</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('direccion') }}" type="text" class="form-control" id="direccion" name="direccion" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="celular" class="form-label">Celular</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input value="{{ old('celular') }}" type="text" class="form-control" id="celular" name="celular" minlength="9" maxlength="9" required>
                                <div class="invalid-feedback">Ingrese un número de celular válido</div>
                            </div>
                            <div class="col-lg-2">
                                <label for="celular" class="form-label">Sexo</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <select class="form-select" name="sexo_id" required>
                                    <option></option>
                                    @foreach ($sexos as $sexo)
                                    <option value="{{ $sexo->sexo_id }}" {{ old('sexo_id') == $sexo->sexo_id ? 'selected' : '' }}>{{ $sexo->descripcion }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="my-1">
                            <a type="button" class="btn btn-secondary" onclick="limpiarFormulario()">Limpiar</a>
                            <button type="submit" class="btn btn-primary ms-2">Registrarse</button>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <span>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="link-primary">Logueate aquí</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('dist/js/clear.js') }}"></script>
@endsection
