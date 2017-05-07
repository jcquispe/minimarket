<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model {

	protected $table = 'ingresos';
	
	protected $fillable = ['cod', 'compra', 'fecha_ingreso', 'observacion', 'anulado', 'fecha_anulado', 'motivo_anulado', 'user_id', 'proveedor', 'factura', 'total'];

}
