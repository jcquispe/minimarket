<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingresos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cod', 10);
			$table->string('compra', 20);
			$table->timestamp('fecha_ingreso');
			$table->string('observacion', 500)->nullable();
			$table->boolean('anulado');
			$table->timestamp('fecha_anulado')->nullable();
			$table->string('motivo_anulado', 500)->nullable();
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('proveedor', 500);
			$table->integer('factura');
			$table->float('total');
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
		Schema::drop('ingresos');
	}

}
