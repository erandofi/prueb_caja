 <!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
        <h1 class="page-header">
            Beneficiario <small> / Ingreso de beneficiario</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li class="active"><i class="icon-dashboard"></i> Registrar</li>
            <li><a ui-sref='home.consultar_beneficiario'><i class="icon-dashboard"></i> Consultar</a></li>
         </ol>
     </div>
 </div> 
 <a href="" ui-sref="home.consultar_beneficiario"><i class="fa fa-search fa-2x" tittle="consultar anticipos"></i></a>
                <br/><br/>                   
<div class="row">
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Registrar beneficiario</h3>
         </div>

         <div class="panel-body">
             <div class="col-lg-6">
                 <div class="form-group">
                            <label>Razon social:</label>
                            <input class="form-control" required="" ng-model='beneficiarioVO.nombre'>
                            <p class="help-block">(*)Digite el nombre del beneficiario.</p>
                        </div>

                   <div class="form-group">
                            <label>Identificación:</label>
                            <input class="form-control" required="" ng-model='beneficiarioVO.identificacion'>
                            <p class="help-block">(*)Digite la identificacióm del beneficiario.</p>
                        </div>
                   <div class="form-group">
                            <label>Dirección:</label>
                                <input class="form-control" required="" ng-model='beneficiarioVO.direccion'>
                        </div>
                    <div class="form-group">
                            <label>Telefono:</label>
                                <input class="form-control" required="" ng-model='beneficiarioVO.telefono'>
                            
                        </div> 

                 <div class="panel-body">
                                <div class="row"><!--INICIO FILA-->
                                    <button class="btn btn-primary " type="button" id="btnCrearConductor" ng-click='guardar()'>{{ beneficiarioVO.id > 0 ? 'Actualizar' : 'Registrar'  }}</button>
                                </div><!--FINAL FILA-->
                        </div>             
             </div>
         </div>
    </div>
</div>