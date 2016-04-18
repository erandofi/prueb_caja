confControllers.controller('HomeController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http,$route, $routeParams) {

	$scope.listaMenu=[];
	$scope.nombreUsuario=authUsuario.nombreUsuario();

	$scope.ListaArrayMenu=[{
			destino:'home.beneficiario',
			imagen:'fa fa-users',
			etiqueta:'Beneficiario'
		},
		{
			destino:'home.prestamo',
			imagen:'fa fa-ticket',
			etiqueta:'Prestamos'
		},
		{			
			destino:'home.periodo',
			imagen:'fa fa-briefcase',
			etiqueta:'Periodo'
		},
		{			
			destino:'home.salidas',
			imagen:'fa fa-dollar',
			etiqueta:'Salidas'
		},
		{			 
			destino:'home.anticipo',
			imagen:'fa fa-dollar',
			etiqueta:'Consignaciones'
		},
		{			
			destino:'home.egresos',
			imagen:'fa fa-list-alt',
			etiqueta:'Egresos'
		},
		{			
			destino:'home.balancegeneral',
			imagen:'fa fa-bar-chart-o',
			etiqueta:'Balance general'
		}];

	if (!authUsuario.estaLogueado()) {
		$state.go('login');
	};

		$scope.$route = $route;
        $scope.$location = $location;
        $scope.$routeParams = $routeParams;



	$scope.consultarmenu=function(){

	 $http.post("menu/consultarmenu",{_token:authUsuario.token()}).success(function(data, status, headers, config) {

	 	$scope.listaMenu=data;
        
      });


	}

	$scope.desloguear=function(){

		//$state.go('http://52.26.19.129/sinin/index.php');
		authUsuario.desloguear();	
		window.location.href='http://52.26.19.129/sinin/home.php';

 	};



});
