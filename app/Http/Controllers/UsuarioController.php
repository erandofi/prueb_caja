<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\models\Usuario;
use App\funciones\Encriptacion;
use Input;

class UsuarioController extends Controller {

	/**
	 * [Loguear Inicio de sesion de usuario]
	 * @param Request $request [input de la vista]
	 */
	public function Loguear(Request $request){


		$credeciales=array('usuario'=>$request->input('usuario'),
			'password'=>$request->input('clave'));
		$result=DB::select('EXEC validar_acceso_caja :usuario,:password',$credeciales);		
		
		if ($result[0]->id > 0) {

			Session::put("id_usuario",$result[0]->id);
			$usuario = Usuario::find($result[0]->id);
			Session::put("id_empresa",$usuario->empresa);			
			return array('id'=>$result[0]->id,
				'nombre'=>$usuario->persona->nombre_completo(),'_token'=>csrf_token());
			
		}

		return "Error";
	}

	public function Desloguear(){

	  Session::flush();
	  return array('id'=>0,'nombre'=>'','_token'=>'');		

	}

	public function VerificarLogueo(){

		if (Session::has('id_usuario')){
			return array('id'=>Session::get('id_usuario'),'nombre'=>'','_token'=>csrf_token());
		}else{
			return array('id'=>0,'nombre'=>'','_token'=>'');
		}
		
	}

	public function LoguearDesdeSinin()
	{
		try {
			
			$arrayUsuario=Encriptacion::decryptArray(Input::get('cadena'));

			$resultado = time() - $arrayUsuario['tiempo'];

			if ($resultado >= 20) {
				return 'Error';
			}

			$usuario=Usuario::find($arrayUsuario['id_usuario']);
			
			Session::put("id_usuario",$usuario->id);			
			Session::put("id_empresa",$usuario->empresa);	

			return array('id'=>$usuario->id,
				'nombre'=>$usuario->persona->nombre_completo(),'_token'=>csrf_token());
	

		} catch (Exception $e) {
			return $e->getMessage();
		}	
	}	

}
