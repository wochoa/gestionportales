<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaginaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina', function (Blueprint $table) {
            $table->increments('id_pagina');
            $table->text('nom_pagina')->nullable();
            $table->text('nom_archivophp')->nullable();
            $table->longText('cont_pagina')->nullable();
            $table->datetime('fecha_pag')->nullable();
            $table->integer('activo_pag')->default(1);
            $table->integer('iddirecciones_web')->nullable();
            $table->integer('iduser')->nullable();
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
        Schema::dropIfExists('pagina');
    }
}
