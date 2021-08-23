<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadEjecutoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_ejecutora', function (Blueprint $table) {
            $table->increments('ue_codigo');
            $table->integer('ue_anio')->nullable();
            $table->integer('ue_codigo_nro')->nullable();
            $table->text('ue_descripcion')->nullable();
            $table->integer('ue_codigo_nacional')->nullable();
            $table->integer('sector')->nullable();
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
        Schema::dropIfExists('unidad_ejecutora');
    }
}
