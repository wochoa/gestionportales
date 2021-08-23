<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenu', function (Blueprint $table) {
            $table->increments('idsubmenu');
            $table->text('nom_submenu')->nullable();
            $table->text('link_submenu')->nullable();
            $table->text('archivo')->nullable();
            $table->text('idpagina')->nullable();
            $table->integer('activo_submenu')->default(1);
            $table->text('ico_submenu')->nullable();
            $table->integer('idmenus')->nullable();
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
        Schema::dropIfExists('submenu');
    }
}
