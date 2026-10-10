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
        Schema::create('dentistas_especialidades', function (Blueprint $table) {

            $table->unsignedBigInteger('dentista_id');
            $table->unsignedBigInteger('especialidad_id');

            $table->primary(['dentista_id', 'especialidad_id']);

            $table->foreign('dentista_id')->references('usuario_id')->on('usuarios');
            $table->foreign('especialidad_id')->references('especialidad_id')->on('especialidades');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentistas_especialidades');
    }
};
