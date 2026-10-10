@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('admin.especialidades') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.especialidades.store') }}" method="post" class="needs-validation" novalidate>

                @csrf

                <div class="card my-3">
                    <div class="card-header">Insertar Especialidad</div>
                    @error('especialidad_id') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    @error('descripcion') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="especialidad_id" class="form-label">ID</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('especialidad_id') }}" type="text" class="form-control" id="especialidad_id" name="especialidad_id" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                            </div>
                            <div class="col-lg-8">
                                <input value="{{ old('descripcion') }}" type="text" class="form-control" id="descripcion" name="descripcion" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.especialidades') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Insertar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
