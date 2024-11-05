<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegvisitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regvisita', function (Blueprint $table) {
            $table->increments('idregvisita');
            $table->text('dni')->nullable();
            $table->text('nombre')->nullable();
            $table->text('motivo')->nullable();
            $table->datetime('fechaingreso')->nullable();
            $table->integer('estado')->default(1);
            $table->datetime('fechasalida')->nullable();
            $table->integer('ofi_codigo')->nullable();
            $table->text('nom_oficina')->nullable();
            $table->text('nom_funcionario')->nullable();
            $table->string('tipo_persona')->nullable();
            $table->integer('iddirecciones_web')->nullable();
            $table->text('iprocedencia')->nullable();// institucion de procedencia
            $table->string('institucion')->nullable();
            $table->string('cargo')->nullable();
            $table->string('lugar')->nullable();
            $table->text('observaciones')->nullable();

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
        Schema::dropIfExists('regvisita');
    }
}
