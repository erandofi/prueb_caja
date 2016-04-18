<?php namespace App\Http\Controllers;
setlocale(LC_MONETARY, 'en_US');

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\models\Legalizaciones;
use App\models\Egresos;
use App\models\Legalizacion_Anticipo;
use App\models\Legalizacion_Documentos;

use Maatwebsite\Excel\Facades\Excel;
use Input;
use File;
use Session;
/**
 * Controlador para los periodos
 */
class LegalizacionesController extends Controller {
	/**
	 * [Registrar Agregar un nuevo periodo de legalización]
	 * @param Request $request [contiene los input de la vista]
	 */
	public function Registrar(Request $request){

		$rs=Legalizaciones::create(array(

			'fecha_inicio'=>date('Y-m-d',strtotime($request->input('fecha_inicio'))),
			'fecha_final'=>date('Y-m-d',strtotime($request->input('fecha_final'))),
			'id_responsable'=>$request->input('id_responsable'),
			'nombre'=>$request->input('nombre'),
			'id_estado'=>1

		));

		return $rs['id'] > 0 ? 'Success' : 'Error';

	}

	public function Actualizar(Request $request){

		$leg=Legalizaciones::find($request->input('id'));

	    $leg->fecha_inicio=date('Y-m-d',strtotime($request->input('fecha_inicio')));
	    $leg->fecha_final=date('Y-m-d',strtotime($request->input('fecha_final')));
	    $leg->id_responsable=$request->input('id_responsable');
	    $leg->nombre=$request->input('nombre');
	    $rs=$leg->save();
	    
	    return $rs > 0 ? 'Success' : 'Error';

	}


	public function ActualizarEstado(){

		$leg=Legalizaciones::find(Input::get('id'));

	    $leg->id_estado=2;
	    $rs=$leg->save();
	    
	    return $rs > 0 ? 'Success' : 'Error';

	}


	public function Consultar(Request $request){

		$result=DB::select('EXEC lgn.consultar_periodos :id_empresa',array(Session::get('id_empresa')));		
			
		return $result;
	}

	public function Consultaridlegalizacion(){
				$credeciales=array('id'=>Input::get('id_legalizacion'),
			'id_empresa'=>Session::get('id_empresa'));

		$result=DB::select('EXEC lgn.consultar_periodos_id :id,:id_empresa',$credeciales);		
			
		return $result;
	}

	public function ConsultarPorCodigo($id){

		$leg=Legalizaciones::find($id);

		return array(
			'id'=>$leg->id,
			'fecha_inicio'=>$leg->fecha_inicio,
			'fecha_final'=>$leg->fecha_final,
			'id_responsable'=>$leg->id_responsable,
			'nombre'=>$leg->nombre,
			'_token'=>csrf_token()
			);
		
	}

	public function consultarPorEstado(){

		//$leg=Legalizaciones::where('id_estado','=',1)->get();
		$leg=DB::table('lgn.legalizaciones as l')
				->join('funcionario as f','f.id','=','l.id_responsable')
				->join('persona as p','f.id_persona','=','p.id')
				->select('l.id as id','l.nombre','p.nombres','p.apellidos')
				->whereRaw('l.id_estado=1 AND f.id_empresa='.Session::get('id_empresa'))->get();

		return $leg;
	}

	public function subirArchivos()
	{	

			//dd(Input::file());
			foreach (Input::file('archivos') as $key => $file) {
				
				$nombreArchivo=rand(11111,99999).'.' . Input::file('archivos')[$key]->getClientOriginalExtension();

				Input::file('archivos')[$key]->move(
				    base_path() . '/public/sources/', $nombreArchivo
				);

				$rs=legalizacion_documentos::create(array(

					'id_legalizacion'=>Input::get('id_legalizacion'),
					'nombre'=>$nombreArchivo,
					'ruta'=>'/sources/'

				));
			}

			/**/

		return $rs['id'] > 0 ? 'Success' : 'Error';
	}

	public function consultararchivos(){

		$leg=legalizacion_documentos::where('id_legalizacion','=',Input::get('id_legalizacion'))->get();

		return $leg;
	}


	 public function descargarImagen($id){ 

         $plano = legalizacion_documentos::find($id); 


         $nombregenerado = $plano->ruta.$plano->nombre; 
          
  
         $ruta = url($nombregenerado);

         return response()->download('sources/'.$plano->nombre,$plano->nombre);

        //header('Location:'.$ruta); 

         //exit(); 
    }  


	public function ExcelPeriodo(){
		
		$anticipos=Legalizacion_Anticipo::where('id_legalizacion','=',Input::get('id_legalizacion'))->get();

		Excel::create('Reporte Periodo',function($excel)
		{

			$excel->sheet('Sheetname',function($sheet){

 			//$result=Legalizaciones::where('id','=',Input::get('id_legalizacion'))->first();
			$result=DB::table('lgn.legalizaciones as l')
				->join('funcionario as f','f.id','=','l.id_responsable')
				->join('persona as p','p.id','=','f.id_persona')
				->select(DB::raw('l.id as id,l.nombre as nombre, CONCAT(p.nombres,'."' '".',p.apellidos) as nombrecompleto'))
				->whereRaw('l.id='.Input::get('id_legalizacion').' AND f.id_empresa='.Session::get('id_empresa'))->first();	
 			//id anterior id anterior legalizacion
 			//$previousUserID = Legalizaciones::where('id', '<', $result->id)->max('id');
				$previousUserID=DB::table('lgn.legalizaciones as l')
				->join('funcionario as f','f.id','=','l.id_responsable')
				->select('l.id as id')
				->whereRaw('l.id <'.$result->id.' AND f.id_empresa='.Session::get('id_empresa'))->max('l.id');
 			//fin id anterior legalizacion

 			//id siguiente legalizacion
			$nextUserID = Legalizaciones::where('id', '>', $result->id)->min('id');
			//fin id siquiente legalizacion

			$Egresosanterior=Egresos::where('id_legalizacion','=',$previousUserID)->get();

			//$anticiposanterior=Legalizacion_Anticipo::where('id_legalizacion','=',$previousUserID)->get();



			$anticiposanterior=DB::select('EXEC lgn.consultar_periodos_id :id',array($previousUserID));

			$totanterior=0;

			$totanticipoanterior=0;


			foreach ($anticiposanterior as $key => $value) {

				$totanticipoanterior=$value->total_caja;
			}

			$saldoanterior=$totanticipoanterior;


 			$Egresos=Egresos::where('id_legalizacion','=',Input::get('id_legalizacion'))->get();

 			$anticipos=Legalizacion_Anticipo::where('id_legalizacion','=',Input::get('id_legalizacion'))->get();


							$sheet->setBorder('B1:H1','medium');
							$sheet->setColumnFormat(array(
    								'H:H' => '$#,##0_-'
							));

							$sheet->setStyle(array(
			                    	'font' => array(
			                        'name'      =>  'Calibri',
			                        'size'      =>  12,
			                        'bold'      =>  false
			                    )
                			));

                			$sheet->cell('B5:H5', function($cell) {

                				$cell->setAlignment('center');
                				$cell->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11',
    									 'bold'       =>  true
								));

							});


                			$sheet->cell('B3', function($cell) {

                				$cell->setAlignment('center');
                				$cell->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11',
    									 'bold'       =>  true
								));

							});

							$sheet->cell('C3', function($cells) {
								$cells->setBorder('', 'none', 'thin', 'none');								
							});


							$sheet->setAutoSize(true);

							$sheet->mergeCells('B1:H1');

							$sheet->setWidth('A', 10);

							$sheet->setWidth('B', 11);

							$sheet->setWidth('C', 29);

							$sheet->setWidth('D', 34);

							$sheet->setWidth('E', 54);

							$sheet->setWidth('F', 11);

							$sheet->setWidth('G', 21);

							$sheet->setWidth('H', 13);

							$sheet->cell('B1:H1', function($cells) {

								$cells->setAlignment('center');
								$cells->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11',
    									 'bold'       =>  true
								));

							});



							$sheet->row(1, array(
										'','LEGALIZACION DE GASTOS '.$result->nombre
							 ));

							$sheet->row(3, array(
										'','NOMBRE',$result->nombrecompleto,'',''
							 )


							);

							$sheet->setBorder('B5:H5','medium');
							$sheet->row(5, array(
										'','FECHA','NIT','BENEFICIARIO','CONCEPTO','SUBTOTAL','IVA','TOTAL'
							 )


							);

							$cont=6;
							$tot=0;
							foreach ($Egresos as $key => $value) {
								$sheet->cell('B1:B'.$cont, function($cells) {

								$cells->setAlignment('center');
								$cells->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11'
								));

							});

							$sheet->setColumnFormat(array(
    								'F'.$cont.':G'.$cont => '$#,##0_-'
							));

										$sheet->setBorder('B'.$cont.':H'.$cont,'thin');
								 
										$sheet->row($cont,array(
									    '',
										$value->fecha,
										$value->beneficiario['identificacion'],
										$value->beneficiario['nombre'],
										$value->concepto,
										$value->sub_total,
										$value->iva,
										$value->total

										));
										$tot=$tot+$value->total;
										$cont++;

								}
							$sheet->setBorder('B'.$cont.':H'.$cont,'thin');	
							$campo1=$cont+1;
							$sheet->setBorder('B'.$campo1.':H'.$campo1,'thin');
							$campo3=$cont+2;
							$sheet->setBorder('B'.$campo3.':H'.$campo3,'thin');
							$border=$cont+3;
							$sheet->setBorder('B'.$border.':H'.$border,'none');
							//$cells=$sheet->row($cont+3);
							//$cells->setBorder('none', 'none', 'solid', 'none');
							$sheet->row($cont+3, array(
										'','TOTAL GASTOS','','','','','',$tot
							 )
							);

							$ps1=$cont+3;
							$ps7=$cont+10;

							$sheet->cell('B'.$ps1.':B'.$ps7, function($cells) {

								$cells->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11',
    									 'bold'       =>  true
								));

																
							});


							
							$sheet->cell('D'.$ps1.':D'.$ps7, function($cells) {

								$cells->setAlignment('right');
								$cells->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11',
    									 'bold'       =>  true
								));

							});

							$ps2=$ps1+1;

							$sheet->cell('F'.$ps2, function($cells) {

								$cells->setAlignment('left');
								$cells->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11',
    									 'bold'       =>  true
								));

							});

							$sheet->setColumnFormat(array(
    								'D'.$ps1.':D'.$ps7 => '$#,##0_-'
							));

							$sheet->setColumnFormat(array(
    								'H'.$ps1 => '$#,##0_-'
							));

							$sheet->row($cont+6, array(
										'','TOTAL GASTOS','','=H'.$ps1,'','CONSIGNACIONES'
							 )


							);

								$lista=array();
								$totant=0;
								$car=$cont+8;
								$var=$car;
							foreach ($anticipos as $key => $value) {
								
							$sheet->setColumnFormat(array(
    								'H'.$var => '$#,##0_-'
							));

									$lista[]=array(

										'Fecha'=>$value->anticipo['fecha'],
										'Banco'=>$value->anticipo['id_banco_destino'],
										'monto'=>(double)$value->anticipo['monto']//number_format($value->anticipo['monto'],0,",",".")
							);
									
									$totant=$totant+$value->anticipo['monto'];
									$var++;


									
							}

							$totant=$totant+$saldoanterior;

							$saldofavor=0;

							$saldocontra=0;

							

							if($tot>$totant){

								$saldofavor=$tot-$totant;

							}else{

								$saldocontra=-$tot+$totant;
							}

							$sheet->row($cont+7, array(
										'','SALDO A FAVOR','',$saldofavor,'','FECHA','BANCO'
							 )

							


							);

							$ps6=$cont+7;

							$sheet->cell('F'.$ps6.':G'.$ps6, function($cells) {

								$cells->setAlignment('left');
								$cells->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11',
    									 'bold'       =>  true
								));

							});

							$sheet->row($cont+8, array(
										'','SALDO EN CONTRA','',$saldocontra,''
							 )

							);

							$ps5=$cont+5;

							$psfirmas=$cont+10;
							$psfin=$cont+12;
							$psmedio=$ps5+1;

							$psmedio2=$ps5+3;

							$psmedio3=$ps5+5;

							$sheet->cell('E'.$ps5, function($cells) {

								$cells->setAlignment('center');
								$cells->setFont(array(
   										 'family'     => 'Calibri',
    									 'size'       => '11',
    									 'bold'       =>  true
								));

							});

							$sheet->row($ps5, array(
										'','VALOR ANTICIPO','','=H'.$psfin,'SALDO ANTERIOR','','',$saldoanterior
							 )

							);
							
							$puesto=(string)'F'.$car;
							$sheet->fromArray($lista, null, $puesto, false, false);


							$sheet->row($cont+9, array(
										'','FIRMA DE QUIEN LEGALIZA'
							 )

							);

							$sheet->row($cont+10, array(
										'','FIRMA DE QUIEN AUTORIZA'
							)

							);

							$psantefin=$psfin-1;

							$sheet->row($cont+12, array(
										'','','','','','','TOTAL','=SUM(H'.$ps5.':H'.$psantefin.')'
							)

							);


							$sheet->cell('B'.$ps5.':H'.$psfin, function($cells) {
								$cells->setBorder('medium', 'medium', 'medium', 'medium');								
							});

							$sheet->cell('D'.$psmedio, function($cells) {
								$cells->setBorder('thin', 'none', 'thin', 'none');								
							});

							$sheet->cell('D'.$psmedio2, function($cells) {
								$cells->setBorder('thin', 'none', 'thin', 'none');								
							});

							$sheet->cell('D'.$psmedio3, function($cells) {
								$cells->setBorder('thin', 'none', 'thin', 'none');								
							});


							$sheet->cell('B'.$ps1.':H'.$ps1, function($cells) {
								$cells->setBorder('medium', 'medium', 'medium', 'medium');								
							});

							$sheet->cell('B2:H4', function($cells) {
								$cells->setBorder('medium', 'medium', 'medium', 'medium');								
							});



			});

		})->download('xlsx');

		
	}

	public function test()
	{
		return Legalizaciones::all();
	}


}
