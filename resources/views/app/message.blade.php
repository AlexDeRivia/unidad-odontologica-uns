@extends('layouts.welcome')

@section('title', 'Unidad Odontológica')

@section('content')
<div class="container py-5 my-5">

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow">
                <div class="card-header bg-danger">
                    <a href="{{ route('home') }}">
                        <span class="uo-brand d-inline-block my-3">UNS <small>· Unidad Odontológica</small></span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="alert alert-secondary m-0" role="alert">{{ $message }}</div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('login') }}" class="btn btn-primary">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
