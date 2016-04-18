<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Beneficiario;

class BeneficiarioController extends Controller {
	/**
	 * [Registrar Registra los beneficiarios]
	 * @param Request $request [Input]
	 */
	public function Registrar(Request $request){

		$rs=Beneficiario::create(array(
			 'nombre'=>$request->input('nombre'),
			 'identificacion'=>$request->input('identificacion'),
			 'direccion'=>$request->input('direccion'),
			 'telefono'=>$request->input('telefono')
		));

		return $rs['id'] > 0 ? 'Success' : 'Error';

	}
	/**
	 * [Actualizar metodo para actualizar]
	 * @param Request $request [description]
	 */
	public function Actualizar(Request $request){

		$beneficiario=Beneficiario::find($request->input('id'));

	    $beneficiario->identificacion= $request->input('identificacion');
	    $beneficiario->telefono= $request->input('telefono');
	    $beneficiario->direccion= $request->input('direccion');
	    $beneficiario->nombre= $request->input('nombre');
	    $rs=$beneficiario->save();
	    
	    return $rs > 0 ? 'Success' : 'Error';

	}
	/**
	 * [Consultar devuelve todos los beneficiarios]
	 */
	public function Consultar(){
		return Beneficiario::paginate(2);
	}

	
	/**
	 * [ConsultarPorCodigo devuelve los datos de un beneficiario]
	 * @param [type] $id [description]
	 */
	public function ConsultarPorCodigo($id){

		$leg=Beneficiario::find($id);

		return array(
			'id'=>$leg->id,
			'identificacion'=>$leg->identificacion,
			'direccion'=>$leg->direccion,
			'telefono'=>$leg->telefono,
			'nombre'=>$leg->nombre,
			'_token'=>csrf_token()
			);
		
	}

	public function ConsultarTodo(){
		return Beneficiario::get();
	}

}
