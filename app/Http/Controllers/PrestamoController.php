<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\Prestamo;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Session;

class PrestamoController extends Controller {


	//************************ Funcion para registrar el prestamos *******************************

	public function Registrar(Request $request){

		$rs=Prestamo::create(array(
			 'id_quien_presta'=>$request->input('id_quien_presta'),
			 'monto'=>$request->input('monto'),
		     'id_legalizacion'=>$request->input('id_legalizacion'),
		     'fecha'=>$request->input('fecha')
			 
	));

   //return $rs['id'] > 0 ? array('success'=>true,'data'=>$this->Consultar()) : 
   //array('success'=>false,'data'=>'');
		return $rs['id'] > 0 ? 'Success' : 'Error';

	}

    
    //************************ Funcion para actualizar el prestamo ***********************************

	public function Actualizar(Request $request){

		$prestamo=Prestamo::find($request->input('id'));

	    $prestamo->id_quien_presta= $request->input('id_quien_presta');
	    $prestamo->monto= $request->input('monto');
	    $prestamo->id_legalizacion= $request->input('id_legalizacion');
	    $prestamo->fecha= $request->input('fecha');
	   
	    $rs=$prestamo->save();
	    
	    return $rs > 0 ? 'Success' : 'Error';
	    //return $rs > 0 ? array('success'=>true,'data'=>$this->Consultar()) : 
  								 //array('success'=>false,'data'=>'');

	}
	

    //*********************** Funcion para traer resultado por paginacion *****************************

	public function Consultar(){
		//return Prestamo::orderBy('id','desc')->paginate(10);
		return DB::table('lgn.prestamo_caja as pc')
		->join('funcionario as f','f.id','=','pc.id_quien_presta')
		->join('lgn.legalizaciones as l','pc.id_legalizacion','=','l.id')
		->join('persona as p','p.id','=','f.id_persona')
		->select(DB::raw('p.nombres, p.apellidos, pc.*, l.nombre'))
		->where('f.id_empresa','=',Session::get('id_empresa'))
		->orderBy('pc.id','desc')->paginate(10);
	}

	

	//************************* Funcion para consultar por codigo ***************************************

	public function ConsultarPorCodigo($id){

		$pres=Prestamo::find($id);

		return array(
			'id'=>$pres->id,
			'id_quien_presta'=>$pres->id_quien_presta,
			'monto'=>$pres->monto,
			'id_legalizacion'=>$pres->id_legalizacion,
			'fecha'=>$pres->fecha,			
			'_token'=>csrf_token()
			);
		
	}	


	//***************************** Funcion para exportar a excel ************************************

	public function ExportarExcel(){


		

			Excel::create('Informe de Prestamo',function($excel){
				
					$excel->sheet('SheetName',function($sheet){


				  		$prestamos=Prestamo::all();
				        $aar=array();
						foreach ($prestamos as $key => $value) {
								 
								$aar[]=array(

										'Periodo'=>$value->periodo->nombre,
										'Fecha'=>$value->fecha,
										'Funcionario'=>$value->quienpresta->persona->nombre_completo(),
										'Monto'=>$value->monto

								);
						}


					    $sheet->fromArray($aar);

					});

			})->download('xls');
	}



	

		

}
