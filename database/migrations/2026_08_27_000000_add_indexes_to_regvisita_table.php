<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToRegvisitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_pag')->table('regvisita', function (Blueprint $table) {
            // Índice compuesto para la consulta principal de visitas (portal, estado y fecha)
            $table->index(['iddirecciones_web', 'estado', 'fechaingreso'], 'idx_regvisita_portal_estado_fecha');

            // Índice para búsquedas rápidas por DNI
            $table->index('dni', 'idx_regvisita_dni');

            // Índice para búsquedas por código de oficina
            $table->index('ofi_codigo', 'idx_regvisita_ofi_codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_pag')->table('regvisita', function (Blueprint $table) {
            $table->dropIndex('idx_regvisita_portal_estado_fecha');
            $table->dropIndex('idx_regvisita_dni');
            $table->dropIndex('idx_regvisita_ofi_codigo');
        });
    }
};
