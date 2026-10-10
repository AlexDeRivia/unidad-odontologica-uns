@php
    use App\Models\Sexo;
    $usuario = auth('usuarios')->user();
    $sexo = Sexo::find($usuario->sexo_id)->descripcion;
    $usuario['sexo'] = $sexo;
@endphp

<div class="container mt-3">
    <div class="card mb-3" style="max-width: 750px;">
        <div class="card-header">
            Información Personal
        </div>
        <div class="row g-0">
            <div class="col-md-4 p-3">
                <div class="uo-profile-icon" aria-label="Perfil"><i class="fa-solid fa-user" aria-hidden="true"></i></div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-3 text-end d-none d-lg-block">
                            <label for="">DNI: </label>
                        </div>
                        <div class="col-12 col-lg-9">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" value="{{ $usuario->dni }}" aria-label="Disabled input example" disabled readonly>
                                <label class="form-label"><small>DNI</small></label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-3 text-end d-none d-lg-block">
                            <label for="">Nombres: </label>
                        </div>
                        <div class="col-12 col-lg-9">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" value="{{ $usuario->nombres }}" aria-label="Disabled input example" disabled readonly>
                                <label class="form-label"><small>Nombres</small></label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-3 text-end d-none d-lg-block">
                            <label for="">Apellidos: </label>
                        </div>
                        <div class="col-12 col-lg-9">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" value="{{ $usuario->apellidos }}" aria-label="Disabled input example" disabled readonly>
                                <label class="form-label"><small>Apellidos</small></label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-3 text-end d-none d-lg-block">
                            <label for="">Sexo: </label>
                        </div>
                        <div class="col-12 col-lg-9">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" value="{{ $usuario->sexo }}" aria-label="Disabled input example" disabled readonly>
                                <label class="form-label"><small>Sexo</small></label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-3 text-end d-none d-lg-block">
                            <label for="">Fecha de nacimiento: </label>
                        </div>
                        <div class="col-12 col-lg-9">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" value="{{ $usuario->fech_nac }}" aria-label="Disabled input example" disabled readonly>
                                <label class="form-label"><small>Fecha de nacimiento</small></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="card mb-3" style="max-width: 750px;">
        <div class="card-header">
            Información de Contacto
        </div>
        <div class="row g-0">

            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-3 text-end d-none d-lg-block">
                        <label for="">Celular: </label>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" value="{{ $usuario->celular }}" aria-label="Disabled input example" disabled readonly>
                            <label class="form-label"><small>Celular</small></label>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-12 col-lg-3 text-end d-none d-lg-block">
                        <label for="">Dirección: </label>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" value="{{ $usuario->direccion }}" aria-label="Disabled input example" disabled readonly>
                            <label class="form-label"><small>Dirección</small></label>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-12 col-lg-3 text-end d-none d-lg-block">
                        <label for="">Correo: </label>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" value="{{ $usuario->correo }}" aria-label="Disabled input example" disabled readonly>
                            <label class="form-label"><small>Correo</small></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
