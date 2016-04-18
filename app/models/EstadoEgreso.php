<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class EstadoEgreso extends Model {

	//
	protected $table = 'lgn.estado_egreso';
	protected $primaryKey='id';
	//protected $with = array('propiedad');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

}
