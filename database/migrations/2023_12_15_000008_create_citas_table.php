<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {

            $table->id('cita_id');
            $table->unsignedBigInteger('dentista_id');
            $table->unsignedBigInteger('paciente_id');
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('motivo_id');
            $table->unsignedBigInteger('estado_id');
            $table->text('comentario')->nullable();
            $table->text('comentario_dentista')->nullable();

            $table->foreign('dentista_id')->references('usuario_id')->on('usuarios');
            $table->foreign('paciente_id')->references('usuario_id')->on('usuarios');
            $table->foreign('motivo_id')->references('motivo_id')->on('motivos');
            $table->foreign('estado_id')->references('estado_id')->on('estados');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
