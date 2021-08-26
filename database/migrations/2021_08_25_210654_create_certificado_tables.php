<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado', function (Blueprint $table) {
            $table->increments('id_cert');
            $table->date('fecha_entrega');
            $table->string('dni_participante');
            $table->string('partipante');
            $table->string('correo');
            $table->string('puntuacion');
            $table->string('certificado');
            $table->string('fecha_eventos');
            $table->integer('numero_horas');
            $table->integer('id_dirweb');
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
        Schema::dropIfExists('certificado');
    }
}
