<!-- Page Heading -->

 <div class="row">
     <div class="col-lg-12">
 <h1 class="page-header">
  Periodos <small> / Consultar</small>
</h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>             
             <li><a ui-sref='home.periodo'><i class="icon-dashboard"></i> Registrar</a></li>
             <li class="active"><i class="icon-dashboard"></i> Consultar</li>
         </ol>
     </div>
 </div>                
<div class="row" ng-init='consultarPeriodo()'>
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Consultar Periodos</h3>
         </div>

         <div class="panel-body">
            
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>
                       <th>Nombre</th>
                       <th>Funcionario</th>
                       <th>Fecha Inicio</th>
                       <th>Fecha Fin</th>
                       <th>Consignaciones</th>
                       <th>Salida</th>
                       <th>Prestamo</th>
                       <th>Egresos</th>
                       <th>En Caja</th>
                       <th>Opciones </th>
                   </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in ListaPeriodos'>
                            <td ng-if="item.estado==1" class="success">{{item.nombre}}</td>
                            <td ng-if="item.estado==1" class="success">{{item.nombre_completo}}</td>
                            <td ng-if="item.estado==1" class="success">{{item.fecha_inicio}}</td>
                            <td ng-if="item.estado==1" class="success">{{item.fecha_final}}</td>
                            <td ng-if="item.estado==1" class="success">{{item.anticipos | currency:'$':0  }}</td>
                            <td ng-if="item.estado==1" class="success">{{item.consignaciones | currency:'$':0  }}</td>
                            <td ng-if="item.estado==1" class="success">{{item.prestamo | currency:'$':0  }}</td>
                            <td ng-if="item.estado==1" class="success">{{item.egresos | currency:'$':0  }}</td>
                            <td ng-if="item.estado==1" class="success">{{item.total_caja | currency:'$':0  }}</td>
                            <td ng-if="item.estado==1" class="success">
                                <a href="" ng-click='detalle(item.id)'> <i class="fa fa-eye fa-2x"></i> </a>
                                <a ng-if="(item.estado!=2)" ui-sref='home.editar_periodo({id:item.id})' title="Editar"><i class='fa fa-pencil fa-2x'></i></a> 
                                <a ng-if="(item.estado!=2)" ui-sref='home.registrar_legalizacion({id:item.id}) ' title="Asociar anticipo"><i class='fa fa-bars fa-2x'></i></a>
                                <a ng-if="(item.estado!=2)" href="" ng-click="actualizarestado(item.id)" title="Cerrar periodo"><i class='fa fa-times fa-2x'></i></a>
                                <a href="legalizaciones/excelperiodo?id_legalizacion={{item.id}}" target="_blank" title="Informe"> <i class="fa fa-print fa-2x"></i></a>
                                <a href="" ng-click='adjunatr_archivos(item)'> <i class="fa fa-paperclip fa-2x"></i> </a>
                            </td>
                            <td ng-if="item.estado==2">{{item.nombre}}</td>
                            <td ng-if="item.estado==2">{{item.nombre_completo}}</td>
                            <td ng-if="item.estado==2">{{item.fecha_inicio}}</td>
                            <td ng-if="item.estado==2">{{item.fecha_final}}</td>
                            <td ng-if="item.estado==2">{{item.anticipos | currency:'$':0  }}</td>
                            <td ng-if="item.estado==2">{{item.consignaciones | currency:'$':0  }}</td>
                            <td ng-if="item.estado==2">{{item.prestamo | currency:'$':0  }}</td>
                            <td ng-if="item.estado==2">{{item.egresos | currency:'$':0  }}</td>
                            <td ng-if="item.estado==2">{{item.total_caja | currency:'$':0  }}</td>
                            <td ng-if="item.estado==2">
                                <a href="" ng-click='detalle(item.id)'> <i class="fa fa-eye fa-2x"></i> </a>
                                <a ng-if="(item.estado!=2)" ui-sref='home.editar_periodo({id:item.id})' title="Editar"><i class='fa fa-pencil fa-2x'></i></a> 
                                <a ng-if="(item.estado!=2)" ui-sref='home.registrar_legalizacion({id:item.id}) ' title="Asociar anticipo"><i class='fa fa-bars fa-2x'></i></a>
                                <a ng-if="(item.estado!=2)" href="" ng-click="actualizarestado(item.id)" title="Cerrar periodo"><i class='fa fa-times fa-2x'></i></a>
                                <a href="legalizaciones/excelperiodo?id_legalizacion={{item.id}}" target="_blank" title="Informe"> <i class="fa fa-print fa-2x"></i></a>

                            </td>
                        </tr>
                    </tbody>
                </table>
         </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                  <div class="modal-dialog">
                    <div class="modal-content" ng-repeat="item in ListaPeriodoid">
                      <div class="modal-header" >
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Periodo  <span ng-bind="item.nombre"></span></h4>
                      </div>
                      <div class="modal-body">
                                          <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Fecha inicio:</label>
                                                  <span ng-bind="item.fecha_inicio"></span>
                                              </div>
                                              <div class="col-xs-6">
                                                 <label>Fecha fin:</label>
                                                  <span ng-bind="item.fecha_final"></span>
                                              </div>
                                            </div>

                                             <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Nombre:</label>
                                                  <span ng-bind="item.nombre"></span>
                                              </div>
                                              <div class="col-xs-6">
                                                 <label>Funcionario:</label>
                                                  <span ng-bind="item.nombre_completo"></span>
                                              </div>
                                            </div>

                                             <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Entradas:</label>
                                                  <span ng-bind="item.anticipos  | currency:'$':0"></span>
                                              </div>
                                              <div class="col-xs-6">
                                                 <label>Consignacion:</label>
                                                  <span ng-bind="item.consignaciones  | currency:'$':0"></span>
                                              </div>
                                            </div>
                                             <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Egresos:</label>
                                                  <span ng-bind="item.egresos  | currency:'$':0"></span>
                                              </div>
                                              <div class="col-xs-6">
                                                 <label>En Caja:</label>
                                                  <span ng-bind="item.total_caja  | currency:'$':0"></span>
                                              </div>
                                            </div>
                                      <br><br>     
                                  <div class="row" >
                                    <div class="col-xs-12">
                                       <div class="panel panel-info">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Anticipos Registrados</h3>
                                           </div>
                                        <div class="panel-body">
                                            <table class="table table-bordered table-hover table-striped tablesorter">
                                                  <thead>
                                                   <tr>
                                                     <th>Fecha</th>
                                                     <th>Centro de costo</th>
                                                     <th>Monto</th>
                                                     <th>Funcionario</th>
                                                     <th>Banco</th>
                                                 </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr ng-repeat='item in ListaAnticipoRegistrados.data'>
                                                          <td>{{item.anticipo.fecha}}</td>
                                                          <td>{{item.anticipo.centro_costo}}</td>
                                                          <td >{{item.anticipo.monto | currency:'$':0}}</td>
                                                          <td>{{item.anticipo.funcionario.persona.nombres}} {{item.funcionario.persona.apellidos}}</td>
                                                          <td>{{item.anticipo.banco.nombre}}</td>                                              
                                                      </tr>
                                                  </tbody>
                                              </table>
                                       </div>
                                      </div>
                                     </div>  
                                   </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                      </div>
                    
                  </div>
                </div>
            
</div>

</div>



<div class="modal fade" id="modalarchivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Soportes</h4>
      </div>
      <div class="modal-body">
        
            <input type="file" multiple file-multiple-model="archivos"> 

                <div class="panel-body">
                    <table class="table table-bordered table-hover table-striped tablesorter">
                          <thead>
                           <tr>
                             <th>Nombre del archivo</th>
                             <th>Opciones</th>
                         </tr>
                          </thead>
                          <tbody>
                              <tr ng-repeat='item in ListaArchivos'>
                                  <td>{{item.nombre}}</td>
                                  <td><a href="Descargar/archivos/{{item.id}}" target="_blank">Descargar</a></td>                                       
                              </tr>
                          </tbody>
                      </table>
                 </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" ng-click="guardarRuta()">Guardar</button>

       
      </div> 
    </div>
  </div>
</div>

