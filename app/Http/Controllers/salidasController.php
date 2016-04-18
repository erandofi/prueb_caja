<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Salidas; // LUIS AREVALO
use DB;
use Maatwebsite\Excel\Facades\Excel; // LUIS AREVALO
use Session; // LUIS AREVALO
use Input;

class salidasController extends Controller {
	
	// REGISTRAR LAS SALIDAS
	public function Registrar(Request $request){

		$rs=salidas::create(array(
			 'fecha'=>$request->input('fecha'),
			 'monto'=>$request->input('monto'),
			 'funcionario_envia'=>$request->input('funcionario_envia'),
			 'id_legalizacion'=>$request->input('id_legalizacion'),
			 'funcionario_recibe'=>$request->input('funcionario_recibe'),
			 'id_medio_consignacion'=>$request->input('id_medio_consignacion'),
			 'referencia'=>$request->input('referencia')
		));

		return $rs['id'] > 0 ? 'Success' : 'Error';

	}


	public function ConsultarPorCodigo($id){

		$sal=salidas::find($id);

		//return $leg;
		return array(
			'id'=>$sal->id,
			'fecha'=>$sal->fecha,
			'monto'=>$sal->monto,
			'funcionario_envia'=>$sal->funcionario_envia,
			'id_legalizacion'=>$sal->id_legalizacion,
			'funcionario_recibe'=>$sal->funcionario_recibe,
			'id_medio_consignacion'=>$sal->id_medio_consignacion,
			'referencia'=>$sal->referencia,
			'_token'=>csrf_token()
			);
		
	}


	public function Actualizar(Request $request){

		$salidas=salidas::find($request->input('id'));

	    $salidas->fecha= Input::get('fecha');
	    $salidas->monto= Input::get('monto');
	    $salidas->funcionario_envia= Input::get('funcionario_envia');
	    $salidas->id_legalizacion= Input::get('id_legalizacion');
	    $salidas->funcionario_recibe= Input::get('funcionario_recibe');
	    $salidas->id_medio_consignacion= Input::get('id_medio_consignacion');
	    $salidas->referencia= Input::get('referencia');
	    $rs=$salidas->save();
	    
	    return $rs > 0 ? 'Success' : 'Error';

	}

	/**
	 * [Consultar devuelve todos los beneficiarios]
	 */
	/*public function Consultar_salida(){
		return salidas::paginate(10);
	}*/

	// FUNCION PARA CONSULTAR LAS SALIDAS
	public function ConsultarSalida(Request $request){

		//$salida = DB::table('lgn.consignacion')->paginate(10);
		//return $salida;

		$query=null;

		$fdesde=$request->input('fdesde');
		$fhasta=$request->input('fhasta');
		$entrega=$request->input('entrega');
		$medio=$request->input('medio');
		$recibe=$request->input('recibe');
		$periodo=Input::get('periodo');

		if($fdesde!='' || $fhasta!='' || $entrega!='' || $medio!='' || $recibe!='' || $periodo!=''){

			$condicion='';

				if($fdesde!=''){
					$condicion.=" fecha >= '$fdesde' AND";
				}

				if($fhasta!=''){
					$condicion.=" fecha <= '$fhasta' AND";
				}

				if($entrega!=''){
					$condicion.=" funcionario_envia = $entrega AND";
				}

				if($medio!=''){
					$condicion.=" id_medio_consignacion = $medio AND";
				}

				if($recibe!=''){
					$condicion.=" funcionario_recibe = $recibe AND";
				}

				if($periodo!=''){
					$condicion.=" id_legalizacion = $periodo AND";
				}
				$condicion.=" f.id_empresa = ".Session::get('id_empresa')." AND";
				$condicion=substr($condicion,0,-3);
		 		$condicion.=" AND f.id_empresa = ".Session::get('id_empresa');
			//$query=Salidas::whereRaw($condicion)->paginate(10);
			$query=DB::table('lgn.consignacion as c')
			->join('funcionario as f','c.funcionario_envia','=','f.id')
			->join('lgn.medio_de_consignacion as mdc','mdc.id','=','c.id_medio_consignacion')
			->join('persona as p','p.id','=','f.id_persona')
			->select(DB::raw('c.*, mdc.nombre as medio, p.nombres, p.apellidos,(SELECT CONCAT(pe.nombres,'."' '".',pe.apellidos)  from persona pe 
			  inner join funcionario as fu on fu.id_persona=pe.id
			  where fu.id=c.funcionario_envia) as funcionario_quienenvia,(SELECT CONCAT(pe.nombres,'."' '".',pe.apellidos)  from persona pe 
			  inner join funcionario as fu on fu.id_persona=pe.id
			  where fu.id=c.funcionario_recibe) as funcionario_quienrecibe'))
			
			->whereRaw($condicion)->paginate(10);
		
		}else{
			 //$query=Salidas::paginate(10);
			 $query=DB::table('lgn.consignacion as c')
			->join('funcionario as f','c.funcionario_envia','=','f.id')
			->join('lgn.medio_de_consignacion as mdc','mdc.id','=','c.id_medio_consignacion')
			->join('persona as p','p.id','=','f.id_persona')
			->select(DB::raw('c.*, mdc.nombre as medio, p.nombres, p.apellidos,(SELECT CONCAT(pe.nombres,'."' '".',pe.apellidos)  from persona pe 
			  inner join funcionario as fu on fu.id_persona=pe.id
			  where fu.id=c.funcionario_envia) as funcionario_quienenvia,(SELECT CONCAT(pe.nombres,'."' '".',pe.apellidos)  from persona pe 
			  inner join funcionario as fu on fu.id_persona=pe.id
			  where fu.id=c.funcionario_recibe) as funcionario_quienrecibe'))
			->WhereRaw('f.id_empresa ='.Session::get('id_empresa'))->paginate(10);			
		}

		Session::put('consulta_salida',$query);
		return $query;
		//return Salidas::paginate(10);
	}

	// CODIGO DE EXCEL
	public function SalidasExcel(){

		Excel::create('Reporte',function($excel){

			$excel->sheet('Sheetname',function($sheet){

				$lista=Session::get('consulta_salida');
				$listaSalida=array();

				foreach ($lista as $key => $item) {

					$listaSalida[]=array(								
						'Fecha'=>$item->fecha,
						'Monto'=>(integer)$item->monto,
						'Funcionario Envia'=>$item->funcionario_quienenvia,
						'Funcionario Recibe'=>$item->funcionario_quienrecibe,
						'Medio Consignacion'=>$item->medio,
						'Referencia'=>$item->referencia,
						'Periodo'=>$item->periodo->nombre
					);
				}
				$sheet->fromArray($listaSalida);
			});
		})->download('xlsx');
	}


	function Eliminar($id){

		$salida=salidas::find($id);
		$rs=$salida->delete();
		return $rs > 0 ? 'Success' : 'Error';

	}
}