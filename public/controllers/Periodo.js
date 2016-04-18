confControllers.controller('PeriodoController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http,ngProgressFactory) {

	$scope.periodoVO={
		id:0,
		fecha_inicio:'',
		fecha_final:'',
		id_responsable:'',
		nombre:'',
		_token:authUsuario.token()
	};
	$scope.id_legalizacion={id_legalizacion:$state.params.id};
	$scope.ListaPeriodos=[];
	$scope.archivos=null;

	if ($state.params.id > 0) {

		$http.get("legalizaciones/consultarporcodigo/"+$state.params.id).success(function(data, status, headers, config) {

	 	$scope.periodoVO=data;
	 	
      });

	}

	/**
	 * [registrar invoca al registrar de el servidor]
	 * @return {[type]} [description]
	 */
	$scope.guardar=function(){

		if ($scope.periodoVO.id > 0) {

			$http.post("legalizaciones/actualizar",$scope.periodoVO).success(function(data, status, headers, config) {

		 	if (data=='Success') {
		 		swal('Actualizado con exito','','success');  
		 		$state.go('home.consultar_periodo');
		 		//$scope.nuevo();
		 	}else{
		 		swal('error');   
		 	}
		 	
	      });

	}else{

	$http.post("legalizaciones/registrar",$scope.periodoVO).success(function(data, status, headers, config) {

	 	if (data=='Success') {
	 		swal('Datos guardados','','success');  
	 		$scope.nuevo();
	 	}else{
	 		swal('error');   
	 	}
	 	
      });	
	}

	}


	$scope.actualizarestado=function(item){

		$http.post("legalizaciones/actualizarestado",{id:item}).success(function(data, status, headers, config) {

		 	if (data=='Success') {
		 		swal('Actualizado con exito','','success');  
		 		$state.go('home.consultar_periodo');
		 		//$scope.nuevo();
		 	}else{
		 		swal('error');   
		 	}
		 	
	      });

	}

	
	$scope.consultarPeriodo=function(){

	$http.post("legalizaciones/consultar",{_token:authUsuario.token()}).success(function(data, status, headers, config) {

	 	$scope.ListaPeriodos=data;
	 	
      });

	}


	$scope.consultarAnticipo=function(pagina){

	if (pagina==undefined) {pagina=1};
		$http.post("periodo/legalizaciones?page="+pagina).success(function(data, status, headers, config) {

		 	$scope.ListaAnticipo=data;

		 	
	      });

	}

	$scope.consultarAnticipoRegistrados=function(pagina){
		
	if (pagina==undefined) {pagina=1};
		$http.post("periodo/legalizacionesregistradas?page="+pagina,$scope.id_legalizacion).success(function(data, status, headers, config) {

		 	$scope.ListaAnticipoRegistrados=data;

		 	
	      });

	}

	$scope.informeperiodo=function(item){
		
	
		$http.post("legalizaciones/excelperiodo",{id_legalizacion:item}).success(function(data, status, headers, config) {


		 	
	      });

	}

	$scope.detalle=function(id){
		
		$http.post("legalizaciones/periodosid",{id_legalizacion:id}).success(function(data, status, headers, config) {

			$scope.ListaPeriodoid=data;
		});

		$http.post("periodo/legalizacionesregistradas",{id_legalizacion:id}).success(function(data, status, headers, config) {

		 	$scope.ListaAnticipoRegistrados=data;
			$('#myModal').modal('show');
		 	
	      });
		

		//});
	}



	$scope.seleccionar_todo=function(chk){
		
		angular.forEach($scope.ListaAnticipo.data,function(prop,i){
			prop.procesar=chk;			
		});		
	 	
	}

	$scope.comentario=function(){
		var sw=false;	
		angular.forEach($scope.ListaEgresos.data,function(prop,i){
			if(prop.procesar==true){
				sw=true;
			}			
		});		
	 	
	 	if(sw==false){
	 		swal("Por favor seleccionar algun egreso",'','error');

	 	}
	 	

	}

		$scope.legalizarAnticipo=function(){
			var lista=[];


				angular.forEach($scope.ListaAnticipo.data,function(prop,i){

					if(prop.procesar==true){
						lista.push({
							'id':prop.id,
							'id_legalizacion':$state.params.id,
						});
					}
							
				});	

				swal({   title: "¿Esta seguro que desea asociar los anticipos seleccionados?",
		  		 text: "No se podrá eliminar despues",
		      	type: "warning",
		      	showCancelButton: true,
		      	confirmButtonColor: "#DD6B55",
		      	confirmButtonText: "Si",
		      	closeOnConfirm: false },
		      	function(){
		      		$http.post("periodo/registrarlegalizacionanticipo",{lista:lista},{_token:authUsuario.token()}).success(function(data, status, headers, config) {
			 			if (data=='Success') {
			 				
					 		swal("Anticipos asociados", "", "success");
					 		$scope.consultarAnticipo()
					 		$scope.consultarAnticipoRegistrados();


					 	}else{
					 		swal('error');   
					 	}

					});

      		
      		});

				
		}
	/**
	 * [nuevo crea un nuevo periodo]
	 * @return {[type]} [description]
	 */
	$scope.nuevo=function(){

		$scope.periodoVO.id=0,
		$scope.periodoVO.fecha_inicio='',
		$scope.periodoVO.fecha_final='',
		$scope.periodoVO.nombre = '',
		$scope.periodoVO.id_responsable = '',
		$scope.periodoVO._token = authUsuario.token()

	}
	//change necesarios para los tipo fecha
	$('#datetimepicker1').on('dp.change', function(ev){                 
      $scope.periodoVO.fecha_inicio =$('#dtfechaInicio').val();
    });

    $('#datetimepicker2').on('dp.change', function(ev){                 
      $scope.periodoVO.fecha_final =$('#dtfechaFinal').val();
    });

$scope.guardarRuta=function(){

		var formData= new FormData();

		for (var i = 0; i < $scope.archivos.length; i++) {			
			formData.append('archivos[]',$scope.archivos[i]);
		};

		formData.append('id_legalizacion',$scope.obj_periodo.id);
		//formData.append('_token', authUsuario.token());

		/*$http({method : 'post',
                url : 'subirarchivo',
                headers : { 'Content-Type': undefined },
                transformRequest: angular.identity,
                data : formData
       }).then(function(ret) {
                            //var uri = ret.data.uri;
                            //$scope.content = "Upload finished";
//
                            //$scope.postForm.fid = ret.data.fid;
                            //$scope.postForm.buttonDisabled = false;
                             console.log("inside progress");
                            console.log(ret);
                        },
                        function(error) {
                            //$scope.postForm.showError = true;
                            //$scope.postForm.errorMsg = error.data;
                        },
                        function(progress) {
                            console.log("inside progress");
                            console.log(progress)
                        }
                    );*/


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

	$http.post("consultar/archivos",{id_legalizacion:$scope.obj_periodo.id}).success(function(data, status, headers, config) {

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