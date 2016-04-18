confControllers.controller('LoginController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

		
		$scope.loginData={usuario:'', clave:''};

		$scope.loginSubmit = function(){

			var auth = authUsuario.loguear($scope.loginData);

			auth.success(function(response){
				
			if (response.id > 0) {
				SessionSet.cacheSession(response);
				$state.go("home.inicio");				
			}	
			});
		}

		$scope.loguear_desde_sinin=function(){

			$http.post("usuario/loguearcaja",{cadena:$state.params.cadena}).success(function(data, status, headers, config) {

			 	if (data.id > 0) {
					SessionSet.cacheSession(data);
					$state.go("aplicaciones");				
				}else{
					$state.go("login-error");		
				}
			 	
		   });

		}

		if ($state.params.cadena!=undefined && $state.params.cadena!='' && $state.params.cadena!=null) {
			$scope.loguear_desde_sinin();
		};

});