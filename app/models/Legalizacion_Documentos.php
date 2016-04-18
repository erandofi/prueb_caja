<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Legalizacion_Documentos extends Model {

	protected $table = 'lgn.legalizacion_documentos';
	protected $primaryKey='id';
	//protected $with = array('propiedad');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

}
