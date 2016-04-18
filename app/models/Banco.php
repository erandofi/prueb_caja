<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model {

	protected $table = 'banco';
	protected $primaryKey='id';
	//protected $with = array('propiedad');	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

}
