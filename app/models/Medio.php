<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Medio extends Model {

	protected $table = 'lgn.medio_de_consignacion';
	protected $primaryKey='id';
	//protected $with = array('propiedad');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

}
