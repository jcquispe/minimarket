<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgdetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('egdetas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('egreso_id')->unsigned();
			$table->foreign('egreso_id')->references('id')->on('egresos');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('productos');
			$table->integer('cantidad');
			$table->string('unidad');
			$table->float('costo_unidad');
			$table->float('costo_vendido');
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
		Schema::drop('egdetas');
	}

}
