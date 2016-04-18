<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*Route::get('/inicio/login', function(){
	return view('inicio/login');
});*/

use App\models\Funcionario;
use App\models\Banco;
use App\models\Legalizaciones;
use App\models\Medio_de_consignacion; 
use App\models\salidas; 
use App\models\Medio; 
use App\models\GrandesCuentas;
use App\models\EstadoEgreso;
use App\models\Beneficiario;
use App\models\Anticipo;
use App\funciones\Encriptacion;
use App\models\Usuario;

//vistas

//vistas
Route::get('/', function(){
	return view('inicio/index');
});
Route::get('beneficiario/beneficiario', function(){
	return view('beneficiario/beneficiario');
});
Route::get('beneficiario/consultar', function(){
	return view('beneficiario/consultar');
});


/*************************Prestamo Danny- Lopez********************************************/

Route::get('prestamo/prestamo', function(){
	$lista=Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();
	//$listaLegalizacion=Legalizaciones::where('id_estado','=',1)->get();
	$listaLegalizacion=DB::table('lgn.legalizaciones as l')
	->join('funcionario as f','f.id','=','l.id_responsable')
	->select('l.id as id','l.nombre')
	->whereRaw('l.id_estado=1 AND f.id_empresa='.Session::get('id_empresa'))->get();
	return view('prestamo/prestamo',array('funcionarios'=>$lista,'legalizaciones'=>$listaLegalizacion));
});


Route::post('prestamo/registrar','PrestamoController@Registrar');
Route::post('prestamo/actualizar','PrestamoController@Actualizar');
Route::post('prestamo/consultar', 'PrestamoController@Consultar');
Route::get('prestamo/exportarexcel', 'PrestamoController@ExportarExcel');
Route::get('prestamo/consultarporcodigo/{id}', 'PrestamoController@ConsultarPorCodigo');

Route::get('prestamo/editarPrestamo', function(){
	return view('prestamo/editarPrestamo');
});

/********************************fin del prestamo******************************************/
/***Luis Arevalo***/
Route::get('salidas/salidas', function(){
	$lista=Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();
	$lista2=DB::table('lgn.legalizaciones as l')
	->join('funcionario as f','f.id','=','l.id_responsable')
	->select('l.id as id','l.nombre')
	->whereRaw('l.id_estado=1 AND f.id_empresa='.Session::get('id_empresa'))->get();
	$lista3=Medio_de_consignacion::all();
	$lista4=Legalizaciones::all();
	return view('salidas/salidas',array('funcionarios'=>$lista,
										'legalizacion'=>$lista2,
										'medio_de_consignacion'=>$lista3,
										'periodo'=>$lista4));
});

/**Fin Luis Arevalo*****/

/************************************balances Juan Rodriguez****************************************/

Route::get('balance/balancegeneral', function(){
	$lista=Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();
	return view('balance/balancegeneral',array('funcionarios'=>$lista));
});

Route::post('balance/consultar','BalanceController@Consultar');


/***************************************Fin balances**************************************/

/******************************************estado_cuenta***************************************/

Route::get('estado_cuenta/estado_cuenta', function(){
	$lista=Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();
	return view('estado_cuenta/estado_cuenta',array('funcionarios'=>$lista));
	
});

Route::get('estado_cuenta/detalle_estado', function(){
	return view('estado_cuenta/detalle_estado');
});


Route::post('estadocuenta/consultar','Estado_cuentaController@Consultar');

Route::get('estadocuenta/detalle/{id_legalizacion}/{idrecibe}','Estado_cuentaController@Consultarsalida');

Route::get('estadocuenta/detalleegresos/{id_legalizacion}/{idrecibe}','Estado_cuentaController@Consultaregresos');


/**********************************************************************************************/

/*--------------LUIS MENDOZA HERNANDEZ--------------LUIS MENDOZA HERNANDEZ-----------------------LUIS MENDOZA HERNANDEZ**/
/*--------------LUIS MENDOZA HERNANDEZ--------------LUIS MENDOZA HERNANDEZ-----------------------LUIS MENDOZA HERNANDEZ**/
/*----VISTAS----*/
Route::get('anticipo/anticipo', function(){
	$lista=Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();	
	$bancos=Banco::all();
	return view('anticipo/registrar',array('funcionarios'=>$lista,'bancos'=>$bancos));
});
Route::get('anticipo/anticipo_consultar', function(){
	$lista=Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();	
	return view('anticipo/consultar_anticipo',array('funcionarios'=>$lista));
});
/*----PETICIONES----*/
Route::post('anticipo/consulta_paginada', 'AnticipoController@Consultar');
Route::post('anticipo/actualizar','AnticipoController@Actualizar');
Route::post('anticipo/registrar','AnticipoController@Registrar');
Route::get('anticipo/consultarporcodigo/{id}','AnticipoController@ConsultarPorCodigo');
Route::get('anticipo/eliminar/{id}','AnticipoController@Eliminar');
/*--------------LUIS MENDOZA HERNANDEZ--------------LUIS MENDOZA HERNANDEZ-----------------------LUIS MENDOZA HERNANDEZ**/
/*--------------LUIS MENDOZA HERNANDEZ--------------LUIS MENDOZA HERNANDEZ-----------------------LUIS MENDOZA HERNANDEZ**/
Route::get('periodo/periodo', function(){
	$lista=Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();	
	return view('periodo/periodo',array('funcionarios'=>$lista));
});
Route::get('periodo/consultar', function(){
	return view('periodo/consultar');
});

Route::get('periodo/legalizacionanticipo', function(){
	return view('periodo/legalizacionanticipo');
});
/*Vista*/
Route::get('/inicio/login', function(){
	return view('inicio/login');
});

Route::get('/inicio/home', function(){
		
	if (Session::has('id_usuario')) {
		$usuario=Usuario::find(Session::get('id_usuario'));	
		$nombreUsuario=$usuario->persona->nombre_completo();
		return view('inicio/home', array('nombreUsuario'=>$nombreUsuario));
	}else{
		return '';
	}
	
});

Route::get('/inicio/inicio', function(){	
	return view('inicio/inicio');	
});

//Route::get('/inicio/aplicaciones', function(){	
//	return view('inicio/aplicaciones');	
//});

Route::get('/inicio/aplicaciones','InicioController@Aplicaciones');

Route::get('egresos/consultar', function(){
	$lista=EstadoEgreso::all();	
	$lista_1 = Beneficiario::all();
	//$lista_con=salidas::all();
	//return $lista_con->funcionario_recibe;
	$lista_2 = Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();
	$lista_3 = GrandesCuentas::all();
	//return $lista_2;
	return view('egresos/consultar',array('estado_egresos'=>$lista,
										  'beneficiario'=>$lista_1,
										  'funcionario'=>$lista_2,
										  'grandes_cuentas'=>$lista_3));
});
// Jeremy Reyes B. - 2015-06-11
Route::get('egresos/registrar', function() {	

	//$lista_1 = Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();
	$lista_1 = DB::table('funcionario as f')
	->join('persona as p','f.id_persona','=','p.id')
	->join('lgn.consignacion as con','con.funcionario_recibe','=','f.id')
	->select('f.id as id_funcionario','p.nombres','p.apellidos')
	->whereRaw('f.id_empresa='.Session::get('id_empresa'))
	->groupby('f.id','p.nombres','p.apellidos')->get();
	$lista_2 = DB::table('lgn.legalizaciones as l')
	->join('funcionario as f','f.id','=','l.id_responsable')
	->join('persona as p','f.id_persona','=','p.id')
	->select('l.id as id','l.nombre','p.nombres','p.apellidos')
	->whereRaw('l.id_estado=1 AND f.id_empresa='.Session::get('id_empresa'))->get();
	$lista_3 = Beneficiario::all();
	$lista_4 = GrandesCuentas::all();
	$lista_5 = Funcionario::where('id_empresa','=',Session::get('id_empresa'))->get();
	//return $lista_2;
	return view('egresos/registrar',array('funcionarios'	=> $lista_1,
										  'legalizacion'	=> $lista_2,
										  'beneficiario'	=> $lista_3,
										  'grandes_cuentas' => $lista_4,
										  'funcionarios_2'  => $lista_5));	
});
/*Fin vistas*/
/*Fin vistas*/

//servicios
Blade::setContentTags('[[', ']]'); 
Blade::setEscapedContentTags('[[[', ']]]');

/*Usuario*/
Route::post('usuario/loguear', array('uses'=>'UsuarioController@Loguear'));
Route::get('usuario/verificarlogueo', 'UsuarioController@VerificarLogueo');
Route::get('usuario/desloguear', 'UsuarioController@Desloguear');
/*Fin usuario*/

/*Menu*/
Route::post('menu/consultarmenu', 'MenuController@ConsultarMenu');
/*Fin menu*/

/*Beneficiario*/
Route::post('beneficiario/registrar','BeneficiarioController@Registrar');
Route::post('beneficiario/actualizar','BeneficiarioController@Actualizar');
Route::post('beneficiario/consultar', 'BeneficiarioController@Consultar');
Route::get('beneficiario/consultarporcodigo/{id}','BeneficiarioController@ConsultarPorCodigo');
Route::post('beneficiario/consultar_todo', 'BeneficiarioController@ConsultarTodo');
/*Fin beneficiario*/

/*estado de cuenta */

//Route::post('estadocuenta/consultar','Estado_cuentaController@Consultar');


/* fin de estado de cuenta*/

/* INICIO LUIS AREVALO */
Route::post('salidas/registrar','salidasController@Registrar');
Route::post('salidas/actualizar','salidasController@Actualizar');
Route::post('salidas/consulta_salida', 'salidasController@ConsultarSalida');
Route::get('salidas/consultarporcodigo/{id}','salidasController@ConsultarPorCodigo');
Route::get('salidas/eliminar/{id}','salidasController@Eliminar');
Route::get('salidas/salidas_excel', 'salidasController@SalidasExcel');
/* FIN LUIS AREVALO */

/*Egresos*/
Route::post('egresos/consultar','EgresosController@Consultar');
Route::get('egresos/consultarporcodigo/{id}','EgresosController@ConsultarPorCodigo');
Route::get('egresos/consultarporcodigo2/{id}','EgresosController@ConsultarPorCodigo2');

Route::post('egresos/cambiar_estado','EgresosController@ActualizarEstado');
Route::get('egresos/excelegresos','EgresosController@ExcelEgresos');
Route::post('egresos/guardar','EgresosController@Registrar');					// Jeremy Reyes B. - 2015-06-12
Route::post('egresos/consulta_avanzada','EgresosController@ConsultaAvanzada'); 	// Jeremy Reyes B. - 2015-06-12
Route::post('egresos/actualizar','EgresosController@Actualizar');
/*Fin Egresos*/

/*Legalizaciones*/
Route::post('legalizaciones/registrar','LegalizacionesController@Registrar');
Route::post('legalizaciones/actualizarestado','LegalizacionesController@ActualizarEstado');
Route::post('legalizaciones/periodosid','LegalizacionesController@Consultaridlegalizacion');
Route::post('legalizaciones/consultar','LegalizacionesController@Consultar');
Route::get('legalizaciones/excelperiodo','LegalizacionesController@ExcelPeriodo');
Route::get('legalizaciones/consultarporcodigo/{id}','LegalizacionesController@ConsultarPorCodigo');
Route::post('legalizaciones/actualizar','LegalizacionesController@Actualizar');
Route::post('legalizaciones/consultar_estado','LegalizacionesController@consultarPorEstado');
/*Fin legalizaciones*/

/*Balance */
Route::get('balance/reporte','BalanceController@importarexcel');
Route::post('balance/consultavanzada','BalanceController@ConsultaAvanzada');
Route::post('balance/total', 'BalanceController@Total');
/*fin balance */

Route::post('periodo/legalizaciones','AnticipoController@ConsultarAnticipoLegalizacion');
Route::post('periodo/legalizacionesregistradas','AnticipoController@Consultarleganticipo');
Route::post('periodo/registrarlegalizacionanticipo','AnticipoController@RegistrarLegalAnticipo');

//http://caja.com:84/posts-json?page=2
Route::get('posts-json', 'PersonaController@json');



Route::get('test2',function(){

	return salidas::where('id_legalizacion','=',11)->
			       	where('funcionario_recibe','=',13)->get();

});

Route::get('test','LegalizacionesController@consultararchivos');


Route::post('subirarchivo','LegalizacionesController@subirArchivos');

Route::post('consultar/archivos','LegalizacionesController@consultararchivos');

Route::get('Descargar/archivos/{id}','LegalizacionesController@descargarImagen');

Route::post('usuario/loguearcaja','UsuarioController@LoguearDesdeSinin');


Route::get('test5',function(){

	//return Encriptacion::encrypt(array('id_usuario'=>2,'tiempo'=>time()),Encriptacion::ENCRYPTION_KEY);

	$rr="YToyOntzOjEwOiJpZF91c3VhcmlvIjtpOjI7czo2OiJ0aWVtcG8iO2k6MTQ0NDI0NTc0Mjt9";
	$rrdt= Encriptacion::decryptArray($rr);

	return $rrdt;

});


Route::get('juan', 'BalanceController@Total');