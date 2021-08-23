<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlaceinteresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlaceinteres', function (Blueprint $table) {
            $table->increments('idenlaceinteres');
            $table->text('nom_enlaceinteres')->nullable();
            $table->text('link_enlaceinteres')->nullable();
            $table->integer('activo_enlaceinteres')->default(1);
            $table->text('ico_enlaceinteres')->nullable();            
            $table->text('descripcion_web')->nullable();
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
        Schema::dropIfExists('enlaceinteres');
    }
}
