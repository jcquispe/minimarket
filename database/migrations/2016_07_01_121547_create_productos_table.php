<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo',50);
			$table->string('codigo2',50)->nullable();
			$table->string('codigo3',50)->nullable();
			$table->string('descripcion', 500);
			$table->string('imagen',500)->nullable();
			$table->string('unidad', 100);
			$table->float('precio_compra');
			$table->float('precio_venta');
			$table->integer('version');
			$table->boolean('anulado');
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
		Schema::drop('productos');
	}

}
