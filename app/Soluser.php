<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Soluser extends Model {

	protected $table = 'solusers';
	
	protected $fillable = ['nombre', 'ci', 'anulado'];

}
