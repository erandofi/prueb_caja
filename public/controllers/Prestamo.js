
//consulta por codigo

confControllers.controller('PrestamoController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.prestamoVO={id:'',id_quien_presta:'', monto:'', id_legalizacion:'',fecha:'',_token:authUsuario.token()};
	$scope.ListaPrestamo=[];
	$scope.paginado=Array();

	if ($state.params.id > 0) {

		$http.get("prestamo/consultarporcodigo/"+$state.params.id).success(function(data, status, headers, config) {

	 	$scope.prestamoVO=data;
	 	
      });

	}

	
//paginacion
	var crearArray=function (num) {		

		$scope.paginado= new Array();
		for (var i = 0; i < num; i++) {
			$scope.paginado[i]=i+1;
		}
	}

//guardar

	$scope.guardar=function(){

		if ($scope.prestamoVO.id > 0) {

			$http.post("prestamo/actualizar",$scope.prestamoVO).success(function(data, status, headers, config) {

		 	if (data=='Success') {
		 		swal('Actualizado con exito','','success');
		 		//$scope.ListaPrestamo=data.data; 
		 		$state.go($state.current,{},{reload:true}); 
		 		
		 	}else{
		 		swal('error');   
		 	}
		 	  
	      });

		}else{

			$http.post("prestamo/registrar",$scope.prestamoVO).success(function(data, status, headers, config) {

				//$scope.ListaPrestamo=data.data;
		 	//$scope.nuevo();
		 	if(data=='Success'){
		 		swal('Registro Guardado','','success');
		 		//$state.go($state.current,{},{reload:true});
		 		$scope.consultar();
		 	}else{
		 		swal('error');
		 	}
		 	
	      });

		}

	}

	//consulta devolviendo un listado paginado

	$scope.consultar=function(pagina){
	if (pagina==undefined) {pagina=1};
	$http.post("prestamo/consultar?page="+pagina,{_token:authUsuario.token()}).success(function(data, status, headers, config) {

	 	$scope.ListaPrestamo=data;
	 	 crearArray($scope.ListaPrestamo.last_page);
	 	
      });

	}

	$scope.nuevo=function(){

		$scope.prestamoVO.id='';
		$scope.prestamoVO.id_quien_presta='';
		$scope.prestamoVO.monto='';
		$scope.prestamoVO.id_legalizacion='';
		$scope.prestamoVO.fecha='';
		$scope.prestamoVO._token=authUsuario.token();

	}

	$scope.consultar_por_codigo=function(obj){


	$http.get("prestamo/consultarporcodigo/"+obj.id).success(function(data, status, headers, config) {

	 	$scope.prestamoVO=data;
	 	
      });

	}

	$('#datetimepicker1').on('dp.change', function(ev){                 
      $scope.prestamoVO.fecha =$('#dtfechaInicio').val();
    });

});