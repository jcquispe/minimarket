<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('egresos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cod', 10);
			$table->string('venta',20);
			$table->timestamp('fecha_egreso');
			$table->float('total');
			$table->integer('autorizado')->nullable();
			$table->float('pagado');
			$table->boolean('anulado');
			$table->timestamp('fecha_anulado')->nullable();
			$table->string('motivo_anulado', 500)->nullable();
			$table->string('observacion', 500)->nullable();
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('soluser_id')->unsigned();
			$table->foreign('soluser_id')->references('id')->on('solusers');
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
		Schema::drop('egresos');
	}

}
