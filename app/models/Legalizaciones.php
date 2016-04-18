<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Legalizaciones extends Model {

	protected $table = 'lgn.legalizaciones';
	protected $primaryKey='id';
	//protected $with = array('propiedad');	
	protected $with = array('funcionario','anticipos');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;


	public function Funcionario(){

		return $this->belongsTo('App\models\Funcionario', 'id_responsable','id');

	}

	public function Anticipos(){

		return $this->hasMany('App\models\Legalizacion_Anticipo', 'id_legalizacion','id');

	}

	//public function Prestamos(){
//
	//	return $this->hasMany('App\models\Prestamo', 'id_legalizacion','id');
//
	//}



}
