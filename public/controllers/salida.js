confControllers.controller('salidasController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.salidasVO={id:'', 
						fecha:'', 
						monto:'', 
						funcionario_envia:'', 
						id_legalizacion:'',
						funcionario_recibe:'',
						id_medio_consignacion:'',
						referencia:'',
						_token:authUsuario.token()};
	$scope.ListaSalida=[];
	$scope.SconsultaVO={fhasta:'',fhasta:''};

	$scope.tabs = [{
		title: 'Registrar',
		url: 'registrar'
	},{
		title: 'Consultar',
		url: 'consultar'
	}];

    $scope.currentTab = 'registrar';

    $scope.onClickTab = function (tab) {
        $scope.currentTab = tab.url;
    }
    
    $scope.isActiveTab = function(tabUrl) {
        return tabUrl == $scope.currentTab;
    }

	if ($state.params.id > 0) {

		$http.get("salidas/consultarporcodigo/"+$state.params.id).success(function(data, status, headers, config) {

	 	$scope.salidasVO=data;
	 	
      });

	}

	$scope.crearArray=function(num){

		//return new Array(num);
		$scope.paginado=new Array();

		for(var i=0; i<num; i++){

			$scope.paginado[i]=i+1;
		}

	}

	$scope.filtrar_datos=function(){

		/*if($scope.salidasVO.){

		}*/
	}

	$scope.guardar_salida=function(){

		if ($scope.salidasVO.id > 0) {

			$http.post("salidas/actualizar",$scope.salidasVO).success(function(data, status, headers, config) {

		 	if (data=='Success') {
		 		swal('Actualizado con exito','','success');  
		 		$state.go('home.salidas');
		 		//$scope.nuevo();
		 	}else{
		 		swal('error');   
		 	}
		 	
	      });

		}else{

			if($scope.salidasVO.monto==''){

				swal('Error','Debe digitar un monto','error.');

			}else if($scope.salidasVO.fecha==''){

				swal('Error','Debe ingresar una fecha','error');

			}else if($scope.salidasVO.funcionario_envia==$scope.salidasVO.funcionario_recibe){

				swal('Advertencia','El funcionario que entrega no puede ser el mismo que recibe','warning');

			}else{

				$http.post("salidas/registrar",$scope.salidasVO).success(function(data, status, headers, config) {

			 	if (data=='Success'){
			 		swal('Guardado','','success');
			 		$scope.consultar_salida(); 
			 		$state.go('home.salidas'); 
			 		//$scope.nuevo();
			 	}else{
			 		swal('error');   
			 	}
			 	
   		        });

			}
		}

	}

	$scope.consultar_salida=function(pagina){
		
		if(pagina==undefined){pagina=1};


		$http.post("salidas/consulta_salida?page="+pagina,$scope.SconsultaVO).success(function(data, status, headers, config) {

			//alert($scope.ListaSalida=data);
		 	
		 	$scope.ListaSalida=data;
		 	$scope.crearArray($scope.ListaSalida.last_page);
		 	
      	});
	}

	$scope.confirmar=function(obj){

		$scope.id_salida=obj;
		$('#modalConfirmar').modal('show');

	}
	
	$scope.eliminar=function(){
			
		$http.get("salidas/eliminar/"+$scope.id_salida.id).success(function(data, status, headers, config) {	 	 
		 	$scope.ListaSalida.data.splice($scope.ListaSalida.data.indexOf($scope.id_salida),1);
		 	$('#modalConfirmar').modal('hide');
	      });

	}

	$("#datetimepicker1").on("dp.change",function (e) {
        $scope.salidasVO.fecha=angular.element('#fecha').val();        
    });

	$("#datetimepicker2").on("dp.change",function (e) {
        
        $scope.SconsultaVO.fdesde=angular.element('#c_desde').val();
    });

    $("#datetimepicker3").on("dp.change",function (e) {       
        $scope.SconsultaVO.fhasta=angular.element('#c_hasta').val();
    });    

});