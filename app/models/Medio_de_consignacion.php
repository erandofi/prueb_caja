<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Medio_de_consignacion extends Model {

	protected $table = 'lgn.medio_de_consignacion';
	protected $primaryKey='id';
	//protected $with = array('propiedad');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

	/*public function Medio_consignacion(){

		return $this->belongsTo('App\models\consignacion', 'id_medio_consignacion','id');

	}*/

}
