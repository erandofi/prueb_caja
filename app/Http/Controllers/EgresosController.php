<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Egresos;
use App\models\HistorialEgresos;
use App\models\ConsecutivoEgreso;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use DB;
use Input;
//use App\Excel;

class EgresosController extends Controller {

	public function Consultar(){
		return Egresos::paginate(10);
	}

	public function ConsultarPorCodigo($id){

		$leg=Egresos::find($id);

		//return $leg;
		return array(
			'id'=>$leg->id,
			'fecha'=>$leg->fecha,
			'periodo'=>$leg->legalizaciones->nombre,
			'consecutivo'=>$leg->id_consecutivo,
			'beneficiaro'=>$leg->beneficiario->nombre,
			'subtotal'=>$leg->sub_total,
			'iva'=>$leg->iva,
			'retencion'=>$leg->retefuente,
			'concepto'=>$leg->concepto,
			'total'=>$leg->total,
			'cuenta'=>$leg->grandesCuentas->nombre,
			'total'=>$leg->total,
			'estado'=>$leg->estadoEgreso->nombre,
			'observacion'=>$leg->observacion,
			'historialEgresos'=>$leg->historialEgresos,
			'_token'=>csrf_token()
			);
		
	}

	public function ConsultarPorCodigo2($id){

		$leg=Egresos::find($id);

		//return $leg;
		return array(
			'id'=>$leg->id,
			'fecha'=>$leg->fecha,
			'periodo'=>$leg->legalizaciones->id,
			'consecutivo'=>$leg->id_consecutivo,
			'beneficiario'=>$leg->id_beneficiario,
			'subtotal'=>number_format($leg->sub_total),
			'iva'=>number_format($leg->iva),
			'retencion'=>number_format($leg->retefuente),
			'concepto'=>$leg->concepto,
			'total'=>number_format($leg->total),
			'cuenta'=>$leg->grandesCuentas->nombre,			
			'estado'=>$leg->estadoEgreso->nombre,
			'observacion'=>$leg->observacion,
			'funcionario'=>$leg->funcionario_recibe
			);
		
	}


	public function ActualizarEstado(Request $request){

		foreach ($request->input('lista') as $value) {
				$rs=HistorialEgresos::create(array(
				 'id_egreso'=>$value['id'],
				 'comentario'=>$value['comentario'],
				 'id_estado'=>$value['estado']
				));

			if($rs['id'] > 0){

					$Egresos=Egresos::find($value['id']);

				    $Egresos->id_estado=$value['estado'];
				    $rs=$Egresos->save();
				    
				 


			}else{
				return 'Error';
			}	
		}

		   return $rs > 0 ? 'Success' : 'Error';
		
	}


	public function Actualizar(){

		$egreso=Egresos::find(Input::get('id'));

	    $egreso->id_legalizacion= Input::get('periodo');
	    $egreso->id_consecutivo= Input::get('consecutivo');
	    $egreso->fecha= Input::get('fecha');
	    $egreso->id_beneficiario= Input::get('beneficiario');
	    $egreso->concepto= Input::get('concepto');
	    $egreso->sub_total= Input::get('subtotal');
	    $egreso->iva= Input::get('iva');
	    $egreso->retefuente= Input::get('retencion');
	    $egreso->total= Input::get('total');
	    $egreso->observacion= Input::get('observacion');
	    $egreso->funcionario_recibe= Input::get('funcionario');
	    $rs=$egreso->save();
	    
	    return $rs > 0 ? 'Success' : 'Error';

	}
	public function ExcelEgresos(){

		
		
		Excel::create('Reporte Egresos',function($excel)
		{

			$excel->sheet('Sheetname',function($sheet){

							$sheet->setBorder('A1:H1','thin');

							$sheet->setAutoSize(true);

							$sheet->cells('A1:H1',function($cells){

							$cells->setFontWeight('bold');
							$cells->setBackground('#D2D2D2');

							});

				          $Egresos=Egresos::all();
					       $lista=array();
								foreach ($Egresos as $key => $value) {
								 
										$lista[]=array(

										'Fecha'=>$value->fecha,
										'Periodo'=>$value->legalizaciones['nombre'],
										'Consecutivo'=>$value->id_consecutivo,
										'Beneficiario'=>$value->beneficiario['nombre'],
										'Concepto'=>$value->concepto,
										'Cuenta'=>$value->grandesCuentas['nombre'],
										'Total'=>$value->total,
										'Estado'=>$value->estadoEgreso['nombre']

										);

								}


				
 
                $sheet->fromArray($lista);


			});

		})->download('xlsx');

		
	}


	public function Registrar(Request $request) {

		DB::beginTransaction();

		try {
			
			$cons = ConsecutivoEgreso::where('id_empresa','=',Session::get('id_empresa'))->first();
			//!$request->input('observacion') ? $observacion = '' : $observacion = $request->input('observacion');
			$result = Egresos::create(
				array(				
					'id_legalizacion' 		=>$request->input('periodo'),
					'fecha'					=>$request->input('fecha'),
					'id_beneficiario'		=>$request->input('beneficiario'),
					'concepto'				=>$request->input('concepto'),
					'sub_total'				=>$request->input('subtotal'),
					'iva'					=>$request->input('iva'),
					'retefuente'			=>$request->input('retencion'),
					'total'					=>$request->input('total'),
					'funcionario_recibe'	=>$request->input('funcionario'),
					'observacion'			=>$request->input('observacion'),
					'id_grandes_cuentas'	=>4,
					'id_estado'				=>1,
					'id_consecutivo'		=>($cons->consecutivo + 1),
					'id_empresa'			=>Session::get('id_empresa')
				)
			);


			if($result['id'] > 0) {

				$cons->consecutivo = ($cons->consecutivo + 1);
			    $rs = $cons->save();
			}

			DB::commit();

			return $cons->consecutivo;

		} 
		catch (Exception $e) {

			DB::rollback;
		}
		
	}


	public function ConsultaAvanzada(Request $request){
		
		$egreso = new Egresos() ;
		$lista  = $egreso;


		if ($request->input('consecutivo')) {

			$lista = $lista->where('id_consecutivo','=',$request->input('consecutivo'));
		}

		if ($request->input('fechaInicio') || $request->input('fechaFin')) {

			$lista = $lista->whereBetween('fecha',array($request->input('fechaInicio'),$request->input('fechaFin')));
		}

		if ($request->input('funcionario')) {

			$lista = $lista->where('funcionario_recibe','=',$request->input('funcionario'));
		}

		if ($request->input('beneficiario')) {

			$lista = $lista->where('id_beneficiario','=',$request->input('beneficiario'));
		}

		if ($request->input('concepto')) {

			$lista = $lista->where('concepto','Like','%'.$request->input('concepto').'%');
		}

		if ($request->input('cuenta')) {

			$lista = $lista->where('id_grandes_cuentas','=',$request->input('cuenta'));
		}

		$lista=$lista->where('id_empresa','=',Session::get('id_empresa'));

		$lista = $lista->paginate(10);

		return $lista;
	}

}
