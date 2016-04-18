<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Session;

use DB;

use Input;

use App\models\Salidas;

use App\models\Egresos;

class Estado_cuentaController extends Controller {


public function Consultar(Request $request){

		$query=null;
		if(Input::get('funcionario')!='' || Input::get('funcionario')!=null){

			$query=DB::table('lgn.consignacion as A1')
			->join('lgn.legalizaciones as A2','A1.id_legalizacion','=','A2.id')
			->join('dbo.funcionario as A3','A1.funcionario_recibe','=','A3.id')
			->join('dbo.persona as A4','A4.id','=','A3.id_persona')
			->select(DB::raw("A1.funcionario_recibe,A2.id,CONCAT(A4.nombres, ' ' , A4.apellidos) funcionario,
								Sum(monto) salidas,isnull((
									Select Sum(total)
									From lgn.egreso
									Where id_legalizacion = A2.id
									And funcionario_recibe = A1.funcionario_recibe
								),0) As egresos,
								 (sum (monto)- (isnull((
									Select Sum(total)
									From lgn.egreso
									Where id_legalizacion = A2.id
									And funcionario_recibe = A1.funcionario_recibe
								), 0))) as por_legalizar"))
			->Where('A3.id_empresa','=',Session::get('id_empresa'))
			->Where('A3.id','=',Input::get('funcionario'))
			->groupby(DB::raw("A1.funcionario_recibe,
		 A2.id,
		 A1.funcionario_recibe,
		 CONCAT(A4.nombres, ' ' , A4.apellidos)"))->paginate(10);

		}else{
			//return $query=Anticipo::paginate(10);
			$query=DB::table('lgn.consignacion as A1')
			->join('lgn.legalizaciones as A2','A1.id_legalizacion','=','A2.id')
			->join('dbo.funcionario as A3','A1.funcionario_recibe','=','A3.id')
			->join('dbo.persona as A4','A4.id','=','A3.id_persona')
			->select(DB::raw("A1.funcionario_recibe,A2.id,CONCAT(A4.nombres, ' ' , A4.apellidos) funcionario,
								Sum(monto) salidas,isnull((
									Select Sum(total)
									From lgn.egreso
									Where id_legalizacion = A2.id
									And funcionario_recibe = A1.funcionario_recibe
								),0) As egresos,
								 (sum (monto)- (isnull((
									Select Sum(total)
									From lgn.egreso
									Where id_legalizacion = A2.id
									And funcionario_recibe = A1.funcionario_recibe
								), 0))) as por_legalizar"))
			->Where('A3.id_empresa','=',Session::get('id_empresa'))
			->groupby(DB::raw("A1.funcionario_recibe,
		 A2.id,
		 A1.funcionario_recibe,
		 CONCAT(A4.nombres, ' ' , A4.apellidos)"))->paginate(10);
		}
			return $query;
		
	}

	public function Consultarsalida($id_legalizacion,$idfuncionario){

		$query=null; 
		//return Input::get('id_legalizacion');
			//return $query=Anticipo::paginate(10);
			$query=salidas::where('id_legalizacion','=',$id_legalizacion)->
			       			where('funcionario_recibe','=',$idfuncionario)->get();

			return $query;
		
	}


	public function Consultaregresos($id_legalizacion,$idfuncionario){

		$query=null; 
		//return Input::get('id_legalizacion');
			//return $query=Anticipo::paginate(10);
			$query=Egresos::where('id_legalizacion','=',$id_legalizacion)->
			       			where('funcionario_recibe','=',$idfuncionario)->get();

			return $query;
		
	}


}
