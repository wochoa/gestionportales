<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CasProcesoSeleccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cas_proceso_seleccion', function (Blueprint $table) {
            $table->increments('id_proc_sel_cas');
            $table->longText('proc_sel_cas_descripcion')->nullable();
            $table->date('proc_sel_cas_fecha_inicio')->nullable();
            $table->date('proc_sel_cas_fecha_termino')->nullable();
            $table->date('cas_proc_sel_fecha_fin_inscripcion')->nullable();
            $table->date('cas_proc_sel_fecha_resultados')->nullable();
            $table->integer('cas_proc_sel_estado')->nullable();
            $table->time('cas_proc_sel_horainicio')->nullable();
            $table->time('cas_proc_sel_horatermino_inscripcion')->nullable();
            $table->integer('cas_proc_sel_uni_eje')->nullable();
            $table->integer('iddireccionweb')->nullable();
            
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
        Schema::dropIfExists('cas_proceso_seleccion');
    }
}
