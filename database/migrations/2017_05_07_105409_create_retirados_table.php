<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetiradosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('retirados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cod', 10);
			$table->string('retirado',20);
			$table->timestamp('fecha_retirado');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('productos');
			$table->integer('cantidad');
			$table->string('motivo', 500);
			$table->boolean('anulado');
			$table->timestamp('fecha_anulado')->nullable();
			$table->string('motivo_anulado', 500)->nullable();
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('retirados');
	}

}
