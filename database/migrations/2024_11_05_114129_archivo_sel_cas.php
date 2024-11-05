<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArchivoSelCas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivo_sel_cas', function (Blueprint $table) {
            $table->increments('idarchivo_sel_cas');
            $table->text('nom_archivo')->nullable();
            $table->text('url_archivo')->nullable();
            $table->text('archivo_sinurl')->nullable();
            $table->enum('etapa',['INSCRIPCION','CURRICULAR','ENTREVISTA','FINAL'])->nullable();
            $table->integer('id_proceso_selec')->nullable();
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
        Schema::dropIfExists('archivo_sel_cas');
    }
}
