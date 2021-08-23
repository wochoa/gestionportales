<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fag', function (Blueprint $table) {
            $table->increments('idfag');
            $table->integer('ano')->nullable();
            $table->text('mes')->nullable();
            $table->text('img')->nullable();
            $table->text('pdf')->nullable();
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
        Schema::dropIfExists('fag');
    }
}
