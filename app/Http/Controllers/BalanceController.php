<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\models\Banco;
use Session;
use Input;


class BalanceController extends Controller {

	
	public function Total(){

		//$result=DB::select('EXEC lgn.balance_general');		
		$result=DB::table('lgn.legalizaciones as l')
		->join('dbo.funcionario as f','f.id','=','l.id_responsable')
		->select(DB::raw(" SUM([dbo].[fc_calcular_anticipos] (l.id))  total_anticipo, 
			SUM([dbo].[fc_calcular_totalentregado](l.id)) total_entregado,
			SUM([dbo].[fc_calcular_gastospropios](l.id,l.id_responsable)) gastos_propios,
			SUM([dbo].[fc_calcular_prestamo](l.id)) total_presamos,
			SUM([dbo].[fc_calcular_egresos](l.id)) total_egresos,
			SUM([dbo].[fc_calcular_anticipos](l.id) - [dbo].[fc_calcular_totalentregado](l.id))+SUM([dbo].[fc_calcular_prestamo](l.id)) total_caja"))
		->where('l.id_estado','=',2)
		->Where('f.id_empresa','=',Session::get('id_empresa'));

		$lista = $result;


		if (Input::get('ano')) {

			$lista = $lista->where(DB::raw('YEAR(l.fecha_inicio)'),'=',Input::get('ano'));
			$lista = $lista->where(DB::raw('YEAR(l.fecha_final)'),'=',Input::get('ano'));
			
		}


		if (Input::get('funcionario')>0) {

			$lista = $lista->where('l.id_responsable','=',Input::get('funcionario'));
		}

		if (Input::get('periodo')!='') {

			$lista = $lista->where('l.nombre','LIKE','%'.Input::get('periodo').'%');
		}

		return $lista->get();

		
			//return $result;
			
	}


/* archivo importación excel*/
	public function importarexcel(){

		
		Excel::create('balance General', function($excel) {

		    $excel->sheet('Hoja 1', function($sheet) {

		    	$sheet->setBorder('A1:H1','thin');

							$sheet->setAutoSize(true);

							$sheet->cells('A1:H1',function($cells){

							$cells->setFontWeight('bold');
							$cells->setBackground('#D2D2D2');

							});


		/* $result=DB::table('lgn.legalizaciones as l')
		->join('funcionario as f', 'l.id_responsable','=','f.id')
		->join('persona as p', 'f.id_persona','=','p.id')
		->select(DB::raw(" l.nombre as periodo,concat(p.nombres,' ',p.apellidos) as funcionario, 
			isnull(dbo.fc_calcular_anticipos(l.id),0) as total_monto, 
			(dbo.fc_calcular_totalentregado(l.id)) as total_entregado, 
			(dbo.fc_calcular_gastospropios(l.id,f.id_persona)) as gastos_propios, 
			(dbo.fc_calcular_egresos(l.id)) AS egresos,
			ISNULL(dbo.fc_calcular_prestamo(l.id),0) as prestamo,
			isnull(dbo.fc_calcular_anticipos(l.id) - ((select sum(monto) from lgn.consignacion con where con.id_legalizacion = l.id) +(dbo.fc_calcular_gastospropios(l.id,f.id_persona))),0) as total_caja"))
		->Where('f.id_empresa','=',Session::get('id_empresa'))
		->groupBy(DB::raw('l.id,l.nombre,p.nombres,p.apellidos,l.id_responsable,f.id_persona'))->get();*/
$result=DB::select('exec lgn.balance_general ?,?,?,?', array(Session::get('id_empresa'),$request->input('ano'),$request->input('funcionario'),$request->input('periodo')));


		    	$lista=array();


		    	foreach ($result as $key => $value) {

		    			$lista[]=array(

		    					'Periodo'=>$value->periodo,
		    					'Funcionario'=>$value->nombre,
		    					'Total_Entrada'=>$value->total_monto,
		    					'Total Entregado'=>$value->total_entregado,
		    					'Gastos_Propios'=>$value->gastos_propios,
		    					'Prestamos'=>$value->prestamo,
		    					'Total_Egresos'=>$value->egresos,
		    					'En Caja'=>$value->en_caja

		    			);

		    		
		    	}
		    	


		        $sheet->fromArray($lista);

		    });

		})->export('xlsx');
	}

/* fin importacion excel */

/* Busqueda de balance  filtrada*/

	public function ConsultaAvanzada(Request $request){



		
		//$result=DB::table('lgn.legalizaciones as l')
		////->join('lgn.consignacion as c', 'c.id_legalizacion','=','l.id')
		//->join('funcionario as f', 'l.id_responsable','=','f.id')
		//->join('persona as p', 'f.id_persona','=','p.id')
		////->leftJoin('lgn.legalizacion_anticipo as la', 'la.id_legalizacion','=','l.id')
		////->leftJoin('lgn.anticipo as a', 'la.id_anticipo','=','a.id')
		////->leftJoin('lgn.egreso as e', 'e.id_legalizacion','=','l.id')
		//->select(DB::raw(" l.nombre as periodo,concat(p.nombres,' ',p.apellidos) as funcionario, 
		//		isnull(dbo.fc_calcular_anticipos(l.id)+isnull((dbo.fc_calcular_anticipos(dbo.fc_periodo_anterior(l.id_responsable,l.id)))-
		//		((select sum(monto) 
		//		from lgn.consignacion con 
		//		where con.id_legalizacion=dbo.fc_periodo_anterior(l.id_responsable,l.id))),0),0) as total_monto, 
		//		(dbo.fc_calcular_totalentregado(l.id)) as total_entregado, 
		//		(dbo.fc_calcular_gastospropios(l.id,f.id)) as gastos_propios, 
		//		(dbo.fc_calcular_egresos(l.id)) AS egresos, 
		//		ISNULL(dbo.fc_calcular_prestamo(l.id),0) as prestamo,
		//		isnull(dbo.fc_calcular_anticipos(l.id) - ((select sum(monto) 
		//		from lgn.consignacion con where con.id_legalizacion = l.id)+isnull(isnull((dbo.fc_calcular_anticipos(dbo.fc_periodo_anterior(l.id_responsable,l.id)))- ((select sum(monto) from lgn.consignacion con 
		//		where con.id_legalizacion=dbo.fc_periodo_anterior(l.id_responsable,l.id))),0),0)),0) as total_caja"))
		//->Where('f.id_empresa','=',Session::get('id_empresa'))
		//->groupBy(DB::raw('l.id,l.nombre,p.nombres,p.apellidos,l.id_responsable,f.id'));	



		$result=DB::select('exec lgn.balance_general ?,?,?,?', array(Session::get('id_empresa'),$request->input('ano'),$request->input('funcionario'),$request->input('periodo')));

		return $result;
//		$lista = $result;

//		echo $lista;

		/*if ($request->input('ano') ) {

			$lista = $lista->where(DB::raw('YEAR(l.fecha_inicio)'),'=',$request->input('ano'));
			$lista = $lista->where(DB::raw('YEAR(l.fecha_final)'),'=',$request->input('ano'));
			
		}


		if ($request->input('funcionario')>0) {

			$lista = $lista->where('l.id_responsable','=',$request->input('funcionario'));
		}*/

		//return $lista->get();
	}

/* fin de la busqueda*/

//prueba 
	public function test(){
		/*return DB::table('lgn.legalizaciones as l')->
		select(DB::raw('(select l2.nombre from lgn.legalizaciones l2 where l2.id=l.id) as t'))->get();*/
		/*$query=DB::table('lgn.legalizaciones as l')
		->join('lgn.consignacion as c', 'c.id_legalizacion','=','l.id')
		->join('funcionario as f', 'l.id_responsable','=','f.id')
		->join('persona as p', 'f.id_persona','=','p.id')
		->leftJoin('lgn.legalizacion_anticipo as la', 'la.id_legalizacion','=','l.id')
		->leftJoin('lgn.anticipo as a', 'la.id_anticipo','=','a.id')
		->leftJoin('lgn.egreso as e', 'e.id_legalizacion','=','l.id')
		->select(DB::raw(" l.nombre as periodo,concat(p.nombres,' ',p.apellidos)as funcionario,
			isnull(sum(a.monto),0) as total_monto,isnull(sum(c.monto),0) as total_entregado,isnull((select sum(monto)
			     from  [lgn].[consignacion] where funcionario_envia = a.id_funcionario_recibe),0) AS gastos_propios,isnull(
			sum(e.total),0) as egresos,isnull(sum(a.monto) - (sum(c.monto)+(select sum(monto)
			     from  [lgn].[consignacion] where funcionario_envia = a.id_funcionario_recibe)),0) as total_caja "))
		->groupBy(DB::raw(' a.id_funcionario_recibe,l.nombre,p.nombres,p.apellidos'));

		return $query;*/


	}
//fin de prueba	

}

