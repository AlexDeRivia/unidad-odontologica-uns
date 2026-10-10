@extends('layouts.admin')

@section('title', 'Unidad Odontológica')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a type="button" class="ms-auto btn btn-secondary" href="{{ route('admin.sexos') }}">
            <i class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.sexos.update', $sexo) }}" method="post" class="needs-validation" novalidate>

                @csrf
                @method('put')

                <div class="card my-3">
                    <div class="card-header">Editar Sexo</div>
                    @error('sexo_id') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    @error('descripcion') @component('components.alertheader') @slot('alert', $message) @endcomponent @enderror
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="sexo_id" class="form-label">ID</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('sexo_id', $sexo->sexo_id) }}" type="text" class="form-control" id="sexo_id" disabled>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                            </div>
                            <div class="col-lg-8">
                                <input value="{{ old('descripcion', $sexo->descripcion) }}" type="text" class="form-control" id="descripcion" name="descripcion" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.sexos') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection