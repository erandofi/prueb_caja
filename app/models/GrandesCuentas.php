<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GrandesCuentas extends Model {

	//

	protected $table = 'lgn.grandes_cuentas';
	protected $primaryKey='id';
	//protected $with = array('propiedad');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}
