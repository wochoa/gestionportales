<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionesWebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones_web', function (Blueprint $table) {
            $table->increments('iddirecciones_web');
            $table->text('nom_direcciones_web')->nullable();
            $table->text('linkdirecciones_web')->nullable();
            $table->text('dns_direcciones_web')->nullable();
            $table->text('iddependencia')->nullable();
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
        Schema::dropIfExists('direcciones_web');
    }
}
