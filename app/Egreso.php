<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model {

	protected $table = 'egresos';
	protected $fillable = ['cod', 'venta', 'fecha_egreso', 'observacion', 'total', 'autorizado', 'pagado', 'anulado', 'fecha_anulado', 'soluser_id', 'user_id'];

}
