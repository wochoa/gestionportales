<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table) {
            $table->increments('idseccion');
            $table->text('titulo')->nullable();
            $table->longText('texto_enlace')->nullable();
            $table->text('icono')->nullable();
            $table->text('color')->nullable();
            $table->text('enlace')->nullable();
            $table->text('apartado')->nullable();
            $table->text('archivo_imagen')->nullable();
            $table->integer('activo')->default(1);
            $table->text('seccion_pag')->nullable();
            $table->integer('iddirecciones_web')->nullable();            
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
        Schema::dropIfExists('secciones');
    }
}
