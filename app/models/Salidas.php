<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Salidas extends Model {

	protected $table = 'lgn.consignacion';
	protected $primaryKey='id';
	protected $with=array('entrega', 'recibe', 'periodo', 'medio');
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function Entrega(){
		return $this->belongsTo('App\models\Funcionario','funcionario_envia','id');
	}

	public function Recibe(){
		return $this->belongsTo('App\models\Funcionario','funcionario_recibe','id');
	}

	public function Periodo(){
		return $this->belongsTo('App\models\Legalizaciones','id_legalizacion','id');
	}

	public function Medio(){
		return $this->belongsTo('App\models\Medio','id_medio_consignacion','id');
	}

}
