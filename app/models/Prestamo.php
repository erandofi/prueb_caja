<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model {

	protected $table = 'lgn.prestamo_caja';
	protected $primaryKey='id';	
	protected $with=array('quienpresta','periodo');
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function QuienPresta(){

		return $this->belongsTo('App\models\Funcionario','id_quien_presta','id');

	}


	public function Periodo(){

		return $this->belongsTo('App\models\Legalizaciones','id_legalizacion','id');

	}

}

