<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSugerenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sugerencia', function (Blueprint $table) {
            $table->increments('sug_numero');
            $table->integer('sug_anio')->nullable();
            $table->text('sug_email')->nullable();
            $table->text('sug_descripcion')->nullable();
            $table->text('usuario_usu_dni')->nullable();
            $table->text('sug_asunto')->nullable();
            $table->datetime('sug_fechahora')->nullable();
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
        Schema::dropIfExists('sugerencia');
    }
}
