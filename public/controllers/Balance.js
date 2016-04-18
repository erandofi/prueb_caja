confControllers.controller('BalanceController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {
	$scope.ListaBalance=[];
	$scope.paginado=Array();
	$scope.balanceVO={
		ano:'',
		funcionario:'',
		periodo:'',
		_token:authUsuario.token()

	};
	
	

	var crearArray=function (num) {		

		$scope.paginado= new Array();
		for (var i = 0; i < num; i++) {
			$scope.paginado[i]=i+1;
		}
	}


	$scope.consultar=function(){

	$http.post("balance/consultavanzada",$scope.balanceVO).success(function(data, status, headers, config) {

	 	$scope.ListaBalance=data;

	 	$scope.consultarTotal();


	 	
      });

	}

	$scope.consultarTotal=function(){

		$http.post("balance/total",$scope.balanceVO).success(function(data, status, headers, config) {

	 	$scope.TotalBalance=data;


	 	
      });

	}

	

	

});