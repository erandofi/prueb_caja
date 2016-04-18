<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use DB;
use Session;
use App\funciones\Encriptacion;

class InicioController extends Controller {

	public function Aplicaciones()
	{
		$cadena=Encriptacion::encrypt(array('id_usuario'=>Session::get('id_usuario'),'tiempo'=>time()),Encriptacion::ENCRYPTION_KEY);
		return view('inicio/aplicaciones', array('cadena'=>$cadena));
	}



}