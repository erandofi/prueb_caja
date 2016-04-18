<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model {

	protected $table = 'lgn.beneficiario';
	protected $primaryKey='id';	
	protected $guarded = array();
	public static $rules = array();
	public $timestamps = false;

}
