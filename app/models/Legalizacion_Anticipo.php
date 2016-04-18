<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Legalizacion_Anticipo extends Model {

	protected $table = 'lgn.legalizacion_anticipo';
	protected $primaryKey='id';	
	protected $with = array('anticipo');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Anticipo(){

		return $this->belongsTo('App\models\Anticipo', 'id_anticipo','id');

	}

}
