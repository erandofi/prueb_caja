confControllers.controller('EgresosController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.egresoVO = {
		id:$state.params.id,
		periodo:'',
		fecha:'',
		beneficiario:'',
		concepto:'',
		subtotal:'',
		iva:'',
		retencion:'',
		total:'',
		funcionario:'',
		observacion:'',
		cuenta:'',
		fechaInicio:'',
		fechaFin:'',
		consecutivo:'',
		nombre:'',
		identificacion:'',
		direccion:'',
		telefono:'',
		_token:authUsuario.token()
	};
	$scope.ListaEgresos=[];
	$scope.detalleVO=[];
	$scope.estado;


//concepto:'',
//consecutivo_egreso:'',
//fecha:'',
//funcionario_recibe:'',
//historial_egresos:'',
//id:'',
//id_beneficiario:'',
//id_consecutivo:'',
//id_empresa:'',
//id_estado:'',
//id_grandes_cuentas:'',
//id_legalizacion:'',
//iva:'',
//observacion:'',
//retefuente:'',
//sub_total:'',
//total:'',


	if ($state.params.id > 0) {

		$http.get("egresos/consultarporcodigo2/"+$state.params.id).success(function(data, status, headers, config) {

	 	$scope.egresoVO=data;
	 	
      });

	}

	$scope.consultar=function(pagina){
		if(pagina==undefined){pagina=0};
			$http.post("egresos/consultar?page="+pagina,{_token:authUsuario.token()}).success(function(data, status, headers, config) {

	 	$scope.ListaEgresos=data;
	 	$scope.seleccionarTodos=false;
	 	crearArray(data.last_page);
	 	
      });
	}

	$scope.comentario=function(estado){
		var sw=false;	
		angular.forEach($scope.ListaEgresos.data,function(prop,i){
			if(prop.procesar==true){
				sw=true;
			}			
		});		
	 	
	 	if(sw==false){
	 		swal("Por favor seleccionar algun egreso",'','error');

	 	}else{
	 			$scope.estado=estado;
				$('#myModal2').modal('show');
	 	}
	 	

	}

	$scope.detalle=function(id){
		
	 	$http.get("egresos/consultarporcodigo/"+id).success(function(data, status, headers, config) {
	 	$scope.detalleVO=data;
		$('#myModal').modal('show');

		 });
	}

	$scope.excel_egresos=function(){

			$http.get("egresos/excelegresos").success(function(data, status, headers, config) {
		 	 });

	}

	$scope.seleccionar_todo=function(chk){
		
		angular.forEach($scope.ListaEgresos.data,function(prop,i){
			prop.procesar=chk;			
		});		
	 	
	}

	$scope.cambiar_estado=function(){
			var lista=[];
			fec=new Date; 
            dia=fec.getDate(); 
            if (dia<10) dia='0'+dia; 
            mes=fec.getMonth()+1; 
            if (mes<10) mes='0'+mes; 
            anio=fec.getFullYear(); 
            hora=fec.getHours(); 
            minutos=fec.getMinutes();
            segundos=fec.getSeconds();
            fecha=anio+'-'+mes+'-'+dia+' '+hora+':'+minutos+':'+segundos; 

		if($('#comentario').val()==''){

			swal("Por favor colocar un comentario",'','error');	

		}else{
				angular.forEach($scope.ListaEgresos.data,function(prop,i){

					if(prop.procesar==true){
						lista.push({
							'id':prop.id,
							'estado':$scope.estado,
							'comentario':$('#comentario').val(),
							'fecha':fecha
						});
					}
							
				});	

				$http.post("egresos/cambiar_estado",{lista:lista},{_token:authUsuario.token()}).success(function(data, status, headers, config) {
			 			if (data=='Success') {
			 				
					 		swal('Actualizado con exito'); 
					 		$state.go($state.current, {}, {reload: true});
					 		
					 	}else{
					 		swal('error');   
					 	}
				 });

		}		
	 	
	}


	var crearArray=function(num){
			$scope.paginando=[];

			for (var i = 0; i < num; i++) {
					$scope.paginando.push(i+1);

				}	
	}


	$scope.guardar=function(){

		if (!$scope.egresoVO.periodo ||		!$scope.egresoVO.fecha ||		!$scope.egresoVO.beneficiario ||
			!$scope.egresoVO.concepto ||	!$scope.egresoVO.subtotal ||	!$scope.egresoVO.total || !$scope.egresoVO.funcionario) {

			swal('Favor digitar los datos requeridos para completar el registro','','error');
		}

		if(!$scope.egresoVO.iva || !$scope.egresoVO.retencion ){

			$scope.egresoVO.iva=0;
			$scope.egresoVO.retencion=0;

		}
		if ($scope.egresoVO.id > 0) {

			$http.post("egresos/actualizar",$scope.egresoVO).success(function(data, status, headers, config) {

				if (data == "Success") {

			 		swal('Datos actualizados','','success');
			 		
			 		$state.go('home.egresos'); 
			 		
			 	}else{

			 		swal('Error al registrar el egreso');   
			 	}
			});


		}else{

			$http.post("egresos/guardar",$scope.egresoVO).success(function(data, status, headers, config) {

				if (data > 0) {

			 		swal('Egreso creado con el consecutivo No.'+data,'','success');
			 		
			 		$state.go($state.current,{},{reload:true}); 
			 		
			 	}else{

			 		swal('Error al registrar el egreso');   
			 	}
			});
		}
	}

	$scope.guardarBeneficiario=function(){

		if (!$scope.egresoVO.nombre || !$scope.egresoVO.identificacion) {

			swal('Favor digitar los datos requeridos para completar el registro','','error');
		}

		$http.post("beneficiario/registrar",$scope.egresoVO).success(function(data, status, headers, config) {

			if (data == 'Success') {

		 		swal('Se agrego el beneficiario','','success');

		 		$scope.consultarBeneficiario();
		 		
		 	}else{

		 		swal('Error al registrar el beneficiario','','error');   
		 	}
		});
	}

	$scope.filtro=function(){
		
		$('#filtro').modal('show');
	}


	$scope.abrirRegistroBeneficiario=function(){
		
		$('#beneficiarioRegistro').modal('show');
	}

	

	$scope.consultaAvanzada=function(pagina) {

		if(pagina==undefined){pagina=1};

		$http.post("egresos/consulta_avanzada?page="+pagina,$scope.egresoVO).success(function(data, status, headers, config) {

			$scope.ListaEgresos=data;
			$scope.seleccionarTodos=false;
	 		crearArray(data.last_page);
      	});
	}


	$scope.consultarPeriodo=function(){
		
		$http.post("legalizaciones/consultar_estado",{_token:authUsuario.token()}).success(function(data, status, headers, config) {

	 		$scope.ListaPeriodo=data;	 	
      	});
	}

	$scope.consultarBeneficiario=function(){
		
		$http.post("beneficiario/consultar_todo",{_token:authUsuario.token()}).success(function(data, status, headers, config) {

			$scope.ListaBeneficiario=data;	 	
      });
	}
	
	//change necesarios para los tipo fecha
	$('#datetimepicker1').on('dp.change', function(ev){                 
      $scope.egresoVO.fecha =$('#dtfechaInicio').val();
    });
    $('#datetimepicker3').on('dp.change', function(ev){                 
      $scope.egresoVO.fechaInicio =$('#dtpfechaInicio').val();
    });
    $('#datetimepicker2').on('dp.change', function(ev){                 
      $scope.egresoVO.fechaFin =$('#dtpfechaFin').val();
    });

	$('#datetimepicker1').datetimepicker({
	   locale: 'es',
	   format: 'YYYY-MM-DD'
	});
	$('#datetimepicker2').datetimepicker({
	   locale: 'es',
	   format: 'YYYY-MM-DD'
	});
	$('#datetimepicker3').datetimepicker({
	   locale: 'es',
	   format: 'YYYY-MM-DD'
	});



	$scope.guardarRuta=function(){

		var formData= new FormData();

		for (var i = 0; i < $scope.archivos.length; i++) {			
			formData.append('archivos[]',$scope.archivos[i]);
		};

		formData.append('id_legalizacion',$scope.obj_periodo.id_legalizacion);

		$http.post("subirarchivo",formData,
			{transformRequest: angular.identity,
            headers: {'Content-Type': undefined}})
		.success(function(data, status, headers, config) {
		if (data=='Success') {

				$("#modalarchivos").modal("hide");
		 		swal('Imagen Guardada','','success');
		 		
		 	}else{

		 		swal('error'); 

		 	}
		 	
		 	
	    });


		
}

$scope.consultarArchivos=function(){

	$http.post("consultar/archivos",{id_legalizacion:$scope.obj_periodo.id_legalizacion}).success(function(data, status, headers, config) {

		 	$scope.ListaArchivos=data;

		 	
    });

}

$scope.descargarimagen=function(id){

	$http.get("Descargar/archivos/"+id).success(function(data, status, headers, config) {

		 	
    });

}

	$scope.adjunatr_archivos=function(item){

		$scope.obj_periodo=item;	
		$("#modalarchivos").modal("show");
		$scope.consultarArchivos();

	}  


});