<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;
//use App\models\Persona;

class Funcionario extends Model {

	protected $table = 'funcionario';
	protected $primaryKey='id';
	protected $with = array('persona');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;
	
	public function Persona(){

		return $this->belongsTo('App\models\Persona', 'id_persona','id');

	}

	

}
