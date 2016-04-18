
<html ng-app='App'>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="[[  csrf_token() ]]" />
<title>CAJA</title>
<link href="images/llave.png" type="image/x-icon" rel="shortcut icon" />


<style type="text/css">
body{
	background-color: white !important;
}

.slide {
    -webkit-transition: -webkit-transform .7s ease-in-out;
    -moz-transition: -moz-transform .7s ease-in-out;
    -o-transition: -o-transform .7s ease-in-out;
    transition: transform .7s ease-in-out;
    -webkit-transform: translateX(0);
    transform: translateX(0);
}

.slide.ng-enter {
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
}

.slide.ng-enter.ng-enter-active, .slide.ng-leave {
    position: absolute;
    -webkit-transform: translateX(0);
    transform: translateX(0);
}

.slide.ng-leave.ng-leave-active {
    -webkit-transform: translateX(100%);
    transform: translateX(100%);
}

</style>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/sb-admin.css" rel="stylesheet">
<link href="css/plugins/morris.css" rel="stylesheet">
<link rel="stylesheet" href="sweet-alert/sweet-alert.min.css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="js/ngProgress.css">

 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>


<script src="sweet-alert/sweet-alert.min.js"></script>


<script src="js/min/moment.min.js"></script>
<script src="js/locale/es.js" ></script>
<script src="js/bootstrap-datetimepicker.min.js" class="ng-scope"></script>



<script type="text/javascript" src="lib/angular/angular.min.js"></script>
<script type="text/javascript" src="lib/angular/angular-ui-router.min.js"></script>
<script type="text/javascript" src="lib/angular/angular-route.min.js"></script>
<script type="text/javascript" src="lib/angular/angular-sanitize.min.js"></script>
<script type="text/javascript" src="app.js"></script>
<script type="text/javascript" src="run.js"></script>
<script src="js/ngprogress.js"></script>
</head>
<body>
<ui-view></ui-view>


<!--Angular-->


<!--Controladores-->
<script type="text/javascript" src="controllers/Login.js"></script>
<script type="text/javascript" src="controllers/Home.js"></script>
<script type="text/javascript" src="controllers/Beneficiario.js"></script>
<script type="text/javascript" src="controllers/Periodo.js"></script>
<script type="text/javascript" src="controllers/Prestamo.js"></script>
<script type="text/javascript" src="controllers/Balance.js"></script>
<script type="text/javascript" src="controllers/salida.js"></script>
<script type="text/javascript" src="controllers/Anticipo.js"></script>
<script type="text/javascript" src="controllers/Egresos.js"></script>
<script type="text/javascript" src="controllers/estado_cuenta.js"></script>
<script type="text/javascript" src="controles.js"></script>

</body>
</html>