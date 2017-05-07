<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model {

	protected $table = 'productos';
	
	protected $fillable = ['codigo', 'codigo2', 'codigo3', 'descripcion', 'imagen', 'unidad', 'precio_compra', 'precio_venta', 'version', 'anulado'];

}
