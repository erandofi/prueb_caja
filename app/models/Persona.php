<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model {

	protected $table = 'persona';
	protected $primaryKey='id';
	//protected $with = array('persona');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function nombre_completo(){

		return $this->nombres . ' ' . $this->apellidos;

	}


}
