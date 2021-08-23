<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlacerefeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlacerefe', function (Blueprint $table) {
            $table->increments('idenlacerefe');
            $table->text('entidad_ref')->nullable();
            $table->text('img_refe')->nullable();
            $table->text('link_refe')->nullable();
            $table->integer('activo_refe')->default(1);
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
        Schema::dropIfExists('enlacerefe');
    }
}
