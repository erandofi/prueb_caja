<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Egresos extends Model {

	protected $table = 'lgn.egreso';
	protected $primaryKey='id';	
	protected $with = array('consecutivoEgreso','beneficiario','grandesCuentas','estadoEgreso','historialEgresos','legalizaciones');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	public function ConsecutivoEgreso(){

		return $this->belongsTo('App\models\ConsecutivoEgreso', 'id_consecutivo','id');

	}

	public function Beneficiario(){

		return $this->belongsTo('App\models\Beneficiario', 'id_beneficiario','id');

	}

	public function Legalizaciones(){

		return $this->belongsTo('App\models\Legalizaciones', 'id_legalizacion','id');

	}

	public function GrandesCuentas(){

		return $this->belongsTo('App\models\GrandesCuentas', 'id_grandes_cuentas','id');

	}

	public function EstadoEgreso(){

		return $this->belongsTo('App\models\EstadoEgreso', 'id_estado','id');

	}

	public function HistorialEgresos(){

		return $this->hasMany('App\models\HistorialEgresos','id_egreso','id')->orderBy('fecha_ingreso','desc');

	}


	//

}
