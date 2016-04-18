<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ConsecutivoEgreso extends Model {

	protected $table = 'lgn.consecutivo_egreso';
	protected $primaryKey='id';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	//

}
