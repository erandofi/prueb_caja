<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Anticipo extends Model {

	protected $table = 'lgn.anticipo';
	protected $primaryKey='id';
	protected $with = array('banco','funcionario');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Banco(){
			 return $this->belongsTo('App\models\Banco','id_banco_destino','id');
	}

	public function Funcionario(){
			 return $this->belongsTo('App\models\Funcionario','id_funcionario_recibe','id');
	}

}
