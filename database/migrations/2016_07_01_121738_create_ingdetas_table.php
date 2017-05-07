<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngdetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingdetas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ingreso_id')->unsigned();
			$table->foreign('ingreso_id')->references('id')->on('ingresos');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('productos');
			$table->integer('cantidad');
			$table->float('costo_unidad');
			$table->float('costo_total');
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
		Schema::drop('ingdetas');
	}

}
