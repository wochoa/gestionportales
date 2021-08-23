<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemaPortalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tema_portal', function (Blueprint $table) {
            $table->increments('id_tema');
            $table->text('nom_tema')->nullable();
            $table->text('color_tema')->nullable();
            $table->text('logo_tema')->nullable();
            $table->text('top_email')->nullable();
            $table->text('top_fono')->nullable();
            $table->text('top_correocorp')->nullable();
            $table->text('top_transparencia')->nullable();
            $table->text('top_mesapartesvirtual')->nullable();            
            $table->text('favicon')->nullable();
            $table->longText('footer_f1')->nullable();
            $table->longText('footer_f2')->nullable();
            $table->longText('footer_f3')->nullable();
            $table->longText('redes_sociales')->nullable();
            $table->longText('linkpag_facebook')->nullable();
            $table->text('dir_temaweb')->nullable();
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
        Schema::dropIfExists('tema_portal');
    }
}
