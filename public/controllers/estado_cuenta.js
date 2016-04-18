confControllers.controller('EstadocuentaController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {


	$scope.ListaEstadocuenta=[];

	$scope.ListaSalida=[];

	$scope.ListaEgreso=[];

	$scope.criteriosVO={funcionario:''};



	$scope.crearArray=function(num){

		//return new Array(num);
		$scope.paginado=new Array();

		for(var i=0; i<num; i++){

			$scope.paginado[i]=i+1;
		}

	}


	$scope.consultar_estadocuenta=function(pagina){

		
		if(pagina==undefined){pagina=1};


		$http.post("estadocuenta/consultar?page="+pagina,$scope.criteriosVO).success(function(data, status, headers, config) {

			//alert($scope.ListaSalida=data);
		 	
		 	$scope.ListaEstadocuenta=data;
		 	$scope.crearArray($scope.ListaEstadocuenta.last_page);
		 	
      	});
	}


	/*if ($state.params.id > 0) {
	 	 $http.get("estadocuenta/detalle/"+$state.params.id ).success(function(data, status, headers, config) {
		 		$scope.ListaSalida=data;	 	
	      });
	};*/


	$scope.consultar_por_codigo=function(){

 
	$http.get("estadocuenta/detalle/"+$state.params.id+"/"+$state.params.idrecibe).success(function(data, status, headers, config) {

	 	$scope.ListaSalida=data;
	 		//alert($scope.ListaSalida["monto"])
      });

	$http.get("estadocuenta/detalleegresos/"+$state.params.id+"/"+$state.params.idrecibe).success(function(data, status, headers, config) {

	 	$scope.ListaEgreso=data;
	 		//alert($scope.ListaSalida["monto"])
      });

	}


});