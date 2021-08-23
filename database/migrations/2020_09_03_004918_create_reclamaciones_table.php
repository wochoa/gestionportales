<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamaciones', function (Blueprint $table) {
            $table->increments('lib_id');
            $table->integer('lib_anio')->nullable();
            $table->date('lib_fecha')->nullable();
            $table->text('lib_nombresapellidos')->nullable();
            $table->text('lib_domicilio')->nullable();
            $table->text('lib_dni')->nullable();
            $table->text('lib_email')->nullable();
            $table->text('lib_telefono')->nullable();
            $table->text('lib_descripcion')->nullable();
            $table->datetime('lib_fechahora')->nullable();
            $table->text('lib_atendido')->nullable();
            $table->text('lib_atendidodetalle')->nullable();
            $table->datetime('lib_atendidofechahora')->nullable();
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
        Schema::dropIfExists('reclamaciones');
    }
}
