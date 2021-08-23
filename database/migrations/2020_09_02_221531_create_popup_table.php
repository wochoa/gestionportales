<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup', function (Blueprint $table) {
            $table->increments('idpopup');
            $table->text('nompublipopu')->nullable();
            $table->text('nompopup')->nullable();
            $table->text('enlace_popup')->nullable();
            $table->text('titulopopup')->nullable();
            $table->integer('activogral')->default(1);
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
        Schema::dropIfExists('popup');
    }
}
