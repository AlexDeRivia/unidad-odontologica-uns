<?php

use App\Http\Controllers\Admin\CitaController;
use App\Http\Controllers\Admin\DentistaEspecialidadController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MotivoController;
use App\Http\Controllers\Admin\SexoController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dentista\CitaController as DentistaCitaController;
use App\Http\Controllers\Dentista\HomeController as DentistaHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Paciente\CitaController as PacienteCitaController;
use App\Http\Controllers\Paciente\DentistaController;
use App\Http\Controllers\Paciente\HomeController as PacienteHomeController;
use App\Http\Middleware\Rol\Admin;
use App\Http\Middleware\Rol\Dentista;
use App\Http\Middleware\Rol\Paciente;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/nosotros', 'nosotros')->name('nosotros');
    Route::get('/horarios', 'horarios')->name('horarios');
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'store')->name('register.store');
});

Route::middleware(Admin::class)->group(function () {

    Route::controller(AdminHomeController::class)->group(function () {
        Route::get('/admin', 'home')->name('admin.home');
        Route::get('/admin/mi-cuenta', 'miCuenta')->name('admin.mi-cuenta');
    });
    Route::controller(SexoController::class)->group(function () {
        Route::get('/admin/sexos', 'index')->name('admin.sexos');
        Route::get('/admin/sexos/create', 'create')->name('admin.sexos.create');
        Route::post('/admin/sexos', 'store')->name('admin.sexos.store');
        Route::get('/admin/sexos/{sexo}', 'show')->name('admin.sexos.show');
        Route::get('/admin/sexos/{sexo}/edit', 'edit')->name('admin.sexos.edit');
        Route::put('/admin/sexos/{sexo}', 'update')->name('admin.sexos.update');
        Route::delete('/admin/sexos/{sexo}', 'destroy')->name('admin.sexos.destroy');
    });
    Route::controller(MotivoController::class)->group(function () {
        Route::get('/admin/motivos', 'index')->name('admin.motivos');
        Route::get('/admin/motivos/create', 'create')->name('admin.motivos.create');
        Route::post('/admin/motivos', 'store')->name('admin.motivos.store');
        Route::get('/admin/motivos/{motivo}', 'show')->name('admin.motivos.show');
        Route::get('/admin/motivos/{motivo}/edit', 'edit')->name('admin.motivos.edit');
        Route::put('/admin/motivos/{motivo}', 'update')->name('admin.motivos.update');
        Route::delete('/admin/motivos/{motivo}', 'destroy')->name('admin.motivos.destroy');
    });
    Route::controller(EspecialidadController::class)->group(function () {
        Route::get('/admin/especialidades', 'index')->name('admin.especialidades');
        Route::get('/admin/especialidades/create', 'create')->name('admin.especialidades.create');
        Route::post('/admin/especialidades', 'store')->name('admin.especialidades.store');
        Route::get('/admin/especialidades/{especialidad}', 'show')->name('admin.especialidades.show');
        Route::get('/admin/especialidades/{especialidad}/edit', 'edit')->name('admin.especialidades.edit');
        Route::put('/admin/especialidades/{especialidad}', 'update')->name('admin.especialidades.update');
        Route::delete('/admin/especialidades/{especialidad}', 'destroy')->name('admin.especialidades.destroy');
    });
    Route::controller(DentistaEspecialidadController::class)->group(function () {
        Route::get('/admin/especialidades-asignar', 'index')->name('admin.especialidad-asignar');
        Route::get('/admin/especialidades-asignar/{dentista}', 'show')->name('admin.especialidad-asignar.show');
        Route::post('/admin/especialidades-asignar', 'process')->name('admin.especialidad-asignar.process');
    });
    Route::controller(UsuarioController::class)->group(function () {
        Route::get('/admin/usuarios', 'index')->name('admin.usuarios');
        Route::get('/admin/usuarios/create', 'create')->name('admin.usuarios.create');
        Route::post('/admin/usuarios', 'store')->name('admin.usuarios.store');
        Route::get('/admin/usuarios/{usuario}', 'show')->name('admin.usuarios.show');
        Route::get('/admin/usuarios/{usuario}/edit', 'edit')->name('admin.usuarios.edit');
        Route::put('/admin/usuarios/{usuario}', 'update')->name('admin.usuarios.update');
        Route::delete('/admin/usuarios/{usuario}', 'destroy')->name('admin.usuarios.destroy');
    });
    Route::controller(CitaController::class)->group(function () {
        Route::get('/admin/citas', 'index')->name('admin.citas');
    });
});

Route::middleware(Dentista::class)->group(function () {

    Route::controller(DentistaHomeController::class)->group(function () {
        Route::get('/dentista', 'home')->name('dentista.home');
        Route::get('/dentista/mi-cuenta', 'miCuenta')->name('dentista.mi-cuenta');
    });
    Route::controller(DentistaCitaController::class)->group(function () {
        Route::get('/dentista/citas', 'index')->name('dentista.citas');
        Route::get('/dentista/citas/{cita}', 'show')->name('dentista.citas.show');
        Route::post('/dentista/citas/{cita}', 'atender')->name('dentista.citas.atender');
    });
});

Route::middleware(Paciente::class)->group(function () {

    Route::controller(PacienteHomeController::class)->group(function () {
        Route::get('/paciente', 'home')->name('paciente.home');
        Route::get('/paciente/mi-cuenta', 'miCuenta')->name('paciente.mi-cuenta');
    });
    Route::controller(PacienteCitaController::class)->group(function () {
        Route::get('/paciente/citas', 'index')->name('paciente.citas');
        Route::get('/paciente/citas/reservar', 'create')->name('paciente.citas.create');
        Route::post('/paciente/citas', 'store')->name('paciente.citas.store');
        Route::get('/paciente/citas/{cita}', 'show')->name('paciente.citas.show');
        Route::get('/paciente/citas/{cita}/reprogramar', 'edit')->name('paciente.citas.edit');
        Route::put('/paciente/citas/{cita}', 'update')->name('paciente.citas.update');
        Route::delete('/paciente/citas/{cita}', 'cancel')->name('paciente.citas.cancel');
    });
    Route::controller(DentistaController::class)->group(function () {
        Route::get('/paciente/dentistas', 'index')->name('paciente.dentistas');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login.auth');
    Route::post('/logout', 'logout')->name('logout.auth');
});
