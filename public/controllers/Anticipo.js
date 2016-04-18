confControllers.controller('AnticipoController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.anticipoVO={id:'',fecha:'', centro_costo:'', monto:'', id_funcionario_recibe:'', id_banco_destino:'', numero_transaccion:'',observacion:'',_token:authUsuario.token()};
	$scope.ListaAnticipo=[];
	$scope.paginado=Array();
	$scope.id_anticipo=0;

	$scope.criteriosVO={costo:'',funcionario:'',desde:'',hasta:'',_token:authUsuario.token()}

	if ($state.params.id > 0) {
	 	 $http.get("anticipo/consultarporcodigo/"+$state.params.id ).success(function(data, status, headers, config) {
		 		$scope.anticipoVO=data;	 	
	      });
	};
	

	var crearArray=function (num) {	
		$scope.paginado= new Array();
		for (var i = 0; i < num; i++) {
			$scope.paginado[i]=i+1;
		}
	}

	$scope.consultar=function(pagina){

	if (pagina==undefined) {pagina=1};
		$http.post("anticipo/consulta_paginada?page="+pagina,$scope.criteriosVO).success(function(data, status, headers, config) {

		 	$scope.ListaAnticipo=data;
		 	 crearArray($scope.ListaAnticipo.last_page);
		 	
	      });

	}

	$scope.guardar=function(){

		if ($scope.anticipoVO.id > 0) {

			$http.post("anticipo/actualizar",$scope.anticipoVO).success(function(data, status, headers, config) {

			 	if (data=='Success') {
			 		swal('Actualizado con exito','','success');  
			 		$state.go('home.consultar_anticipo');
			 		//$scope.nuevo();
			 	}else{
			 		swal('error','','warning');   
			 	}
		 	
	     	 });

		}else{

			if($scope.anticipoVO.monto==''){

				swal('Error','Debe ingresar un monto','error');

			}else if ($scope.anticipoVO.fecha==''){

				swal('Error','Debe seleccionar una fecha','error');

			}else{

			$http.post("anticipo/registrar",$scope.anticipoVO).success(function(data, status, headers, config) {

			 	if (data=='Success') {
			 		swal('Guardado exitosamente','','success');  
			 		$scope.nuevo();
			 	}else{
			 		swal('error','','error');   
			 	}
		 	
	     	 });
			}

		}

	}

	$('#datetimepicker1').on('dp.change', function(ev){  
		$scope.anticipoVO.fecha =$('#dtfecha').val();
    });

    $('#datetimepicker2').on('dp.change', function(ev){  
		$scope.criteriosVO.desde =$('#desde').val();
    });

    $('#datetimepicker3').on('dp.change', function(ev){  
		$scope.criteriosVO.hasta =$('#hasta').val();
    });

    

	$scope.nuevo=function(){

		$scope.anticipoVO.id='';
		$scope.anticipoVO.fecha='';
		$scope.anticipoVO.centro_costo='';
		$scope.anticipoVO.monto='';
		$scope.anticipoVO.id_funcionario_recibe='';
		$scope.anticipoVO.id_banco_destino='';
		$scope.anticipoVO.numero_transaccion='';
		$scope.anticipoVO.observacion='';
		$scope.anticipoVO._token=authUsuario.token();

	}

	$scope.confirmar=function(obj){

		$scope.id_anticipo=obj;
		$('#modalConfirmar').modal('show');

	}
	
	$scope.eliminar=function(){
			
		$http.get("anticipo/eliminar/"+$scope.id_anticipo.id).success(function(data, status, headers, config) {	 	 
		 	$scope.ListaAnticipo.data.splice($scope.ListaAnticipo.data.indexOf($scope.id_anticipo),1);
		 	$('#modalConfirmar').modal('hide');
	      });

	}

});

