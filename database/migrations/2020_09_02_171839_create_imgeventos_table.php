<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgeventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imgeventos', function (Blueprint $table) {
            $table->increments('idimgeventos');
            $table->text('archivo_img')->nullable();
            $table->text('enlace_ref')->nullable();
            $table->integer('activo_imgevento')->nullable();
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
        Schema::dropIfExists('imgeventos');
    }
}
