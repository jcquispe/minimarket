<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Retirado extends Model {

	protected $table = 'retirados';
	protected $fillable = ['cod', 'retirado', 'fecha_retirado', 'producto_id', 'cantidad', 'motivo', 'anulado', 'fecha_anulado', 'motivo_anulado', 'user_id'];

}
