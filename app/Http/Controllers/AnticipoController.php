<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Anticipo;
use App\models\Legalizacion_Anticipo;
use Input;
use DB;
use Session;

class AnticipoController extends Controller {

	/**
	 * [Consultar devuelve todos los beneficiarios]
	 */
	public function Consultar(Request $request){

		$query=null;

		$costo=$request->input('costo');
		$recibe=$request->input('funcionario');
		$desde=$request->input('desde');
		$hasta=$request->input('hasta');

		if($costo!='' || $recibe!='' || $desde!='' || $hasta!=''){

			$condicion='';

				if($costo!=''){
					$condicion.="centro_costo LIKE '%$costo%' AND";
				}

				if($recibe!=''){
					$condicion.=" id_funcionario_recibe = $recibe AND";
				}

				if($desde!=''){
					$condicion.=" fecha >= '$desde' AND";
				}

				if($hasta!=''){
					$condicion.=" fecha <= '$hasta' AND";
				}

				$condicion=substr($condicion,0,-3);
				$condicion.=" AND f.id_empresa = ".Session::get('id_empresa');
		 
			//return Anticipo::whereRaw($condicion)->paginate(10);
			  return $query=DB::table('lgn.anticipo as a')
			->join('funcionario as f','f.id','=','a.id_funcionario_recibe')
			->join('persona as p','p.id','=','f.id_persona')
			->join('banco as b','b.id','=','a.id_banco_destino')
			->select(DB::raw('a.*,CONCAT(p.nombres,'."' '".',p.apellidos) as nombre_completo,b.nombre as banco'))
			->whereRaw($condicion)->paginate(10);
		
		}else{
			//return $query=Anticipo::paginate(10);
			$query=DB::table('lgn.anticipo as a')
			->join('funcionario as f','f.id','=','a.id_funcionario_recibe')
			->join('persona as p','p.id','=','f.id_persona')
			->join('banco as b','b.id','=','a.id_banco_destino')
			->select(DB::raw('a.*,CONCAT(p.nombres,'."' '".',p.apellidos) as nombre_completo,b.nombre as banco'))
			->WhereRaw('f.id_empresa ='.Session::get('id_empresa'))->paginate(10);

			return $query;
		}
	}

	public function ConsultarAnticipoLegalizacion(){

		
		//return $ant=Anticipo::paginate(10);
			//return $query=Anticipo::paginate(10);	

			$lista=Legalizacion_Anticipo::all();

			$arrayID=array();

			foreach ($lista as $key => $item) {
				$arrayID[]=$item->id_anticipo;
			}

			return $ant=Anticipo::whereNotIn('id',$arrayID)->paginate(10);		
			
	}

	public function Consultarleganticipo(){


		return $ant=Legalizacion_Anticipo::where('id_legalizacion','=',Input::get('id_legalizacion'))->paginate(10);
			//return $query=Anticipo::paginate(10);			
		
	}

	public function ConsultarPorCodigo($id){

		$leg=Anticipo::find($id);

		return array(
			'id'=>$leg->id,
			'fecha'=>$leg->fecha,
			'centro_costo'=>$leg->centro_costo,
			'monto'=>$leg->monto,
			'id_funcionario_recibe'=>$leg->id_funcionario_recibe,
			'id_banco_destino'=>$leg->id_banco_destino,
			'numero_transaccion'=>$leg->numero_transaccion,
			'observacion'=>$leg->observacion,
			'_token'=>csrf_token()
			);
		
	}

	public function Registrar(Request $request){
		try {
			

			$rs=Anticipo::create(array(
			 'fecha'=>$request->input('fecha'),
			 'centro_costo'=>$request->input('centro_costo'),
			 'monto'=>$request->input('monto'),
			 'id_funcionario_recibe'=>$request->input('id_funcionario_recibe'),
			 'id_banco_destino'=>$request->input('id_banco_destino'),
			 'numero_transaccion'=>$request->input('numero_transaccion'),
			 'observacion'=>$request->input('observacion')
		));

		return $rs['id'] > 0 ? 'Success' : 'Error';
		//return'jnjk';

		} catch (Exception $e) {
			return $e->getMessage();
		}	

	}

	public function RegistrarLegalAnticipo(){
		DB::beginTransaction();
		try {


			
		foreach (Input::get('lista') as $key => $item) {

			/*$leganti=Legalizacion_Anticipo::where('id_legalizacion','=',$item['id_legalizacion'])->first();

			if($leganti!=null){

				return 'yareg';

			}else{*/

			$rs=Legalizacion_Anticipo::create(array(
			 'id_legalizacion'=>$item['id_legalizacion'],
			 'id_anticipo'=>$item['id']
		     ));
			//$rs=$item['id'];
			//}
		}

		//print_r( Input::get('lista'));
		//return $rs;			
		DB::commit();
		return $rs['id'] > 0 ? 'Success' : 'Error';

		
		} catch (Exception $e) {
			DB::rollback();
			return $e->getMessage();
		}	

	}


	public function Actualizar(Request $request){

		$anticipo=Anticipo::find($request->input('id'));

	    $anticipo->fecha= $request->input('fecha');
	    $anticipo->centro_costo= $request->input('centro_costo');
	    $anticipo->monto= $request->input('monto');
	    $anticipo->id_funcionario_recibe= $request->input('id_funcionario_recibe');
	    $anticipo->id_banco_destino= $request->input('id_banco_destino');
	    $anticipo->numero_transaccion= $request->input('numero_transaccion');
	    $anticipo->observacion= $request->input('observacion');	    
	    
	    $rs=$anticipo->save();
	    
	    return $rs > 0 ? 'Success' : 'Error';

	}


	function Eliminar($id){

		$anticipo=Anticipo::find($id);
		$rs=$anticipo->delete();
		return $rs > 0 ? 'Success' : 'Error';

	}


}
