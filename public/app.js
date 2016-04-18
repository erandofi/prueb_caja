'use strict';

var App = angular.module('App',  ['ui.router','ngRoute','confControllers','ngProgress']);
var confControllers = angular.module('confControllers', []);

App.config(function($urlRouterProvider, $stateProvider) {

    $urlRouterProvider.otherwise('/aplicaciones');

    $stateProvider
    .state('login', {
      url: "/login",              
      templateUrl: "inicio/login", 
      controller: 'LoginController'
     })
    .state('aplicaciones', {
      url: "/aplicaciones",              
      templateUrl: "inicio/aplicaciones", 
      //controller: 'LoginController'
     })
    .state('login_caja', {
      url: "/login-caja/*cadena",              
      template: "<h1>Redireccionando...</h1>", 
      controller: 'LoginController'
     })
    .state('login-error', {
      url: "/login-error",              
      template: "<h1>Error al ingresar a caja.</h1>", 
      controller: 'LoginController'
     })
    .state('home', {
      url: "/home",              
      templateUrl: "inicio/home", 
      controller: 'HomeController'
     })
    .state('home.inicio', {
      url: "/",              
      templateUrl: "inicio/inicio"
     })
    .state('home.legalizaciones', {
      url: "/legalizaciones",              
      template: "Legalizaciones", 
      //controller: 'HomeController'
     })
    .state('home.beneficiario', {
      url: "/beneficiario",              
      templateUrl: "beneficiario/beneficiario", 
      controller: 'BeneficiarioController'
     })

    
    .state('home.prestamo', {
      url: "/prestamo",              
      templateUrl: "prestamo/prestamo", 
     controller: 'PrestamoController'
     })


    .state('home.editar_prestamo', {
      url: "/editar-prestamo/:id",              
      templateUrl: "prestamo/prestamo", 
      controller: 'PrestamoController'
     })


    /*balance */
     .state('home.balancegeneral', {
      url: "/balance_general",              
      templateUrl: "balance/balancegeneral", 
      controller: 'BalanceController'
     })

    /*fin balance */


     .state('home.editar_beneficiario', {
      url: "/editar-beneficiario/:id",              
      templateUrl: "beneficiario/beneficiario", 
      controller: 'BeneficiarioController'
     })

    .state('home.periodo', {
      url: "/periodo",              
      templateUrl: "periodo/periodo", 
      controller: 'PeriodoController'
     })

    .state('home.consultar_periodo', {
      url: "/consultar-periodo",              
      templateUrl: "periodo/consultar", 
      controller: 'PeriodoController'
     })

    .state('home.registrar_legalizacion', {
      url: "/legalizacion/:id",              
      templateUrl: "periodo/legalizacionanticipo", 
      controller: 'PeriodoController'
     })

    .state('home.editar_periodo', {
      url: "/editar-periodo/:id",              
      templateUrl: "periodo/periodo", 
      controller: 'PeriodoController'
     })
    
    .state('home.estadodecuenta', {
      url: "/estadocuenta",              
      templateUrl: "estado_cuenta/estado_cuenta", 
      controller: 'EstadocuentaController'
    })
    .state('home.estadodecuentadetalle', {
      url: "/estadocuentadetalle/:id/:idrecibe",              
      templateUrl: "estado_cuenta/detalle_estado", 
      controller: 'EstadocuentaController'
    })

    .state('home.salidas', {
      url: "/salidas",              
      templateUrl: "salidas/salidas", 
      controller: 'salidasController'
    })
    .state('home.salidas_editar', {
      url: "/editar-salida/:id",              
      templateUrl: "salidas/salidas", 
      controller: 'salidasController'
    })
    .state('home.salidas.registro', {
      url: "/registro",              
      templateUrl: "salidas/salidas", 
      controller: 'salidasController'
    })
    .state('home.salidas.consulta', {
      url: "/consulta",              
      templateUrl: "salidas/salidas/#consulta", 
      controller: 'salidasController'
    })

    /*-----CREADO POR LUIS MENDOZA 01/06/2015*/
     .state('home.anticipo', {
      url: "/anticipo",              
      templateUrl: "anticipo/anticipo", 
      controller: 'AnticipoController'/*-----AQUI VA EL CONTROLADOR DE ANGULAR*/
     })
     /*-----CREADO POR LUIS MENDOZA 01/06/2015*/
     .state('home.consultar_anticipo', {
      url: "/anticipo-consultar",              
      templateUrl: "anticipo/anticipo_consultar", 
      controller: 'AnticipoController'/*-----AQUI VA EL CONTROLADOR DE ANGULAR*/
     })
     .state('home.anticipo_editar', {
      url: "/anticipo-editar/:id",              
      templateUrl: "anticipo/anticipo", 
      controller: 'AnticipoController'
     })
    .state('home.egresos', {
      url: "/egresos",              
      templateUrl: "egresos/consultar", 
      controller: 'EgresosController'
     })
    // Jeremy Reyes B. - 2015-06-11
    .state('home.registrar', {
      url: "/registrar",              
      templateUrl: "egresos/registrar", 
      controller: 'EgresosController'
     })
    .state('home.editar_egreso', {
      url: "/registrar/:id",              
      templateUrl: "egresos/registrar", 
      controller: 'EgresosController'
     })
    // Fin

     /*------------LUIS ALBERTO MENDOZA HERNANDEZ--------------*/

    .state('home.consultar_beneficiario', {
      url: "/consultar-beneficiario/:pagina?",              
      templateUrl: "beneficiario/consultar",
      controller: 'BeneficiarioController'
     });
     
});

confControllers.factory("SessionService", function(){
    return {
        //obtenemos una sesión //getter
        get : function(key) {
            return sessionStorage.getItem(key)
        },
        //creamos una sesión //setter
        set : function(key, val) {
            return sessionStorage.setItem(key, val)
        },
        //limpiamos una sesión
        unset : function(key) {
            return sessionStorage.removeItem(key)
        }
    }
});

confControllers.factory("SessionSet", function($location,SessionService){
    return {
        //obtenemos una sesión 
        cacheSession : function(usuario){
        SessionService.set("auth", usuario.id > 0);
        SessionService.set("nombre", usuario.nombre);  
        SessionService.set("_token", usuario._token);       
        },
        unCacheSession : function(){
            SessionService.unset("auth");
            SessionService.unset("nombre");
            SessionService.unset("_token");
        }
    }
});

confControllers.factory('authUsuario',function($http,$location,SessionService,SessionSet,$state){

	return{
		loguear:function(credentials){
		var authUser = $http({method:'POST',url:'usuario/loguear',params:credentials});
		return authUser;
		},       
		  desloguear : function(){
            return $http({
                method:'GET',
                url : "usuario/desloguear"
            }).success(function(){
                //eliminamos la sesión de sessionStorage
                SessionSet.unCacheSession();
                $state.go("login");
                //$route.reload();
            });
        },        
		    verificarLogueo : function(){               
            var authUser = $http({method:'GET',url:'usuario/verificarlogueo'});
            authUser.success(function(response){

              if (response.id > 0) {
                  SessionSet.cacheSession(response);                 
                  return SessionService.get("auth");
              }

            });
            
        },
        estaLogueado:function(){
          return SessionService.get("auth");
        },
        token:function(){
          return SessionService.get("_token");
        },
        nombreUsuario:function(){
          return SessionService.get("nombre");
        }        
	}
});  


