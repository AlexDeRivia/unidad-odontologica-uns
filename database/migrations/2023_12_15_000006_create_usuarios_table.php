<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {

            $table->id('usuario_id');
            $table->string('correo');
            $table->string('contrasena');
            $table->string('dni', 8);
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fech_nac');
            $table->string('direccion');
            $table->string('celular', 9);
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('sexo_id');
            $table->unsignedBigInteger('rol_id')->default(3);
            $table->rememberToken();

            $table->foreign('sexo_id')->references('sexo_id')->on('sexos');
            $table->foreign('rol_id')->references('rol_id')->on('roles');

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
