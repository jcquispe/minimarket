<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Egdeta extends Model {

	protected $table = 'egdetas';
	
	protected $fillable = ['egreso_id', 'producto_id', 'cantidad', 'unidad', 'costo_unidad', 'costo_vendido', 'costo_total', 'anulado'];

}
