<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposPuntosIncidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_puntos_incidencia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estado', [\App\Models\TipoPuntoIncidencia::ACTIVO, \App\Models\TipoPuntoIncidencia::INACTIVO])->default(\App\Models\TipoPuntoIncidencia::ACTIVO);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_puntos_incidencia');
    }
}
