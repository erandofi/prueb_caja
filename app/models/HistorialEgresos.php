<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class HistorialEgresos extends Model {

	//
	protected $table = 'lgn.historial_egreso';
	protected $primaryKey='id';
	//protected $with = array('propiedad');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
}
