<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntosDelictivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos_delictivo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo_punto');
            $table->string('nombre', 255);
            $table->string('direccion');
            $table->string('lat');
            $table->string('lng');
            $table->text('observaciones');
            $table->string('imagen', 255);
            $table->enum('estado', [\App\Models\PuntoDelictivo::ACTIVO, \App\Models\PuntoDelictivo::INACTIVO])->default(\App\Models\PuntoDelictivo::ACTIVO);
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
        Schema::dropIfExists('puntos_delictivo');
    }
}
