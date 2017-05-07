<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingdeta extends Model {

	protected $table = 'ingdetas';
	
    protected $fillable = ['ingreso_id', 'producto_id', 'cantidad', 'costo_unidad', 'costo_total', 'anulado'];
}
