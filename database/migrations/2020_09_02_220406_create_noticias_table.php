<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('noticias', function (Blueprint $table) {
			$table->increments('idnoticias');
			$table->text('titulo')->nullable();
			$table->longText('contenido')->nullable();
			$table->text('img1')->nullable();
			$table->text('img2')->nullable();
			$table->text('img3')->nullable();
			$table->integer("activo")->default(1);
			$table->dateTime('fechapubli')->nullable();
			$table->integer('iddirecciones_web')->nullable();
			$table->integer('idcategoria')->nullable();
			$table->integer('iduser')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('noticias');
	}
}
