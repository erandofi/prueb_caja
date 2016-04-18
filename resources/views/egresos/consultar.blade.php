 <!-- Page Heading -->
  <div class="row">
     <div class="col-lg-12">
          <h1 class="page-header">
            Egresos <small> / Consulta de egresos</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>  
             <li class="active"><i class="icon-dashboard"></i> Consultar</li>
         </ol>
     </div>
 </div>                
<div class="row" ng-init="consultaAvanzada()">
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Consultar Egresos</h3>
         </div>

         <div class="panel-body">
          <div class="col-lg-6">
          <a style="color:black;" ui-sref="home.registrar"><i class="fa fa-plus fa-2x" style="cursor:pointer;"></i></a>
          <a style="color:black;" ng-click='filtro()'><i class="fa fa-filter fa-2x" style="cursor:pointer;"></i></a>
          <a style="color:black;" href="egresos/excelegresos"><i class="fa fa-print fa-2x" style="cursor:pointer;"></i></a>
          <button class="btn btn-primary " type="button" id="btnCrearConductor" ng-click='comentario(1)'>Aprobar</button>
          <button class="btn btn-primary " type="button" id="btnCrearConductor" ng-click='comentario(2)'>Rechazar</button>
          </div>
                <br> <br> <br>           
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>
                       <th><input type="checkbox" ng-model='seleccionarTodos' ng-click='seleccionar_todo(seleccionarTodos)'></th>
                       <th>Fecha</th>
                       <th>Periodo</th>
                       <th>Consecutivo</th>
                       <th>Beneficiario</th>
                       <th>Concepto</th>
                       <!--<th>Cuenta</th>-->
                       <th>Total</th>
                       <th>Estado</th>
                       <th>Opciones</th>
                   </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in ListaEgresos.data'>
                            <th><input type="checkbox" ng-model='item.procesar'></th>
                            <td>{{item.fecha}}</td>
                            <td>{{item.legalizaciones.nombre}}</td>
                            <td>{{item.id_consecutivo}}</td>
                            <td >{{item.beneficiario.nombre}}</td>
                            <td>{{item.concepto}}</td>
                            <!--<td>{{item.grandes_cuentas.nombre}}</td>-->
                            <td>{{item.total  | currency:"$":1}}</td>
                            <td>{{item.estado_egreso.nombre}}</td>
                            <td style=" text-align: center;" >                        
                              <a  ng-click='detalle(item.id)' class="editar" style="cursor:pointer" title="Detalle del egreso" >
                              <i class="fa fa-eye fa-2x"></i>                      
                              </a>
                              <a  ui-sref='home.editar_egreso({id:item.id})' title="Editar"><i class='fa fa-pencil fa-2x'></i></a> 
                              <a href="" ng-click='adjunatr_archivos(item)'> <i class="fa fa-paperclip fa-2x"></i> </a>                            
                            </td>
                          </tr>
                    </tbody>
                </table>
              <div class="dataTables_paginate paging_simple_numbers col-lg-6">
              <ul class="pagination">
              <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultaAvanzada(0)'>Inicio</a>
              </li>
              <li ng-if='!(ListaEgresos.current_page == 1)' style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultaAvanzada(ListaEgresos.current_page-1)'>Anterior</a>
              </li>
              <li style='cursor:pointer;' ng-repeat='n in paginando'
              ng-class='ListaEgresos.current_page==n ? "active": ""'>
                <a ng-click='consultaAvanzada(n)'>{{n}}</a>
              </li>
              
              <li ng-if='!(ListaEgresos.current_page == ListaEgresos.last_page)' style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultaAvanzada(ListaEgresos.current_page+1)'>Siguiente</a>
              </li> 
              <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultaAvanzada(ListaEgresos.last_page)'>Fin</a>
               </li>
               
              </ul>
              </div>
         </div>
             </div>
</div>

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Egresos No <span ng-bind="detalleVO.consecutivo"></span></h4>
                      </div>
                      <div class="modal-body">
                                          <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Fecha:</label>
                                                  <span ng-bind="detalleVO.fecha"></span>
                                              </div>
                                              <div class="col-xs-6">
                                                 <label>Subtotal:</label>
                                                  <span ng-bind="detalleVO.subtotal | currency:'$':2"></span>
                                              </div>
                                            </div>

                                             <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Periodo:</label>
                                                  <span ng-bind="detalleVO.periodo"></span>
                                              </div>
                                              <div class="col-xs-6">
                                                 <label>Iva:</label>
                                                  <span ng-bind="detalleVO.iva | currency:'$':2"></span>
                                              </div>
                                            </div>

                                             <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Beneficiaro:</label>
                                                  <span ng-bind="detalleVO.beneficiaro"></span>
                                              </div>
                                              <div class="col-xs-6">
                                                 <label>Retencion:</label>
                                                  <span ng-bind="detalleVO.retencion | currency:'$':2"></span>
                                              </div>
                                            </div>
                                             <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Concepto:</label>
                                                  <span ng-bind="detalleVO.concepto"></span>
                                              </div>
                                              <div class="col-xs-6">
                                                 <label>Total:</label>
                                                  <span ng-bind="detalleVO.total | currency:'$':2"></span>
                                              </div>
                                            </div>
                                             <div class="row">
                                              <!--<div class="col-xs-6">
                                                  <label>Cuenta:</label>
                                                  <span ng-bind="detalleVO.cuenta"></span>
                                              </div>-->
                                              <div class="col-xs-6">
                                                 <label>Estado:</label>
                                                  <span ng-bind="detalleVO.estado"></span>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-xs-6">
                                                  <label>Observacion:</label>
                                               </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-xs-1">
                                                  <span ng-bind="detalleVO.observacion"></span>
                                               </div>
                                            </div>
                                      <br><br>     
                                  <div class="row">
                                    <div class="col-xs-12">
                                       <div class="panel panel-info">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Historial</h3>
                                           </div>
                                        <div class="panel-body">
                                            <table class="table table-bordered table-hover table-striped tablesorter">
                                                  <thead>
                                                   <tr>
                                                     <th>Fecha</th>
                                                     <th>Comentario</th>
                                                     <th>Estado</th>
                                                 </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr ng-repeat='item in detalleVO.historialEgresos'>
                                                          <td>{{item.fecha_ingreso | limitTo:19}}</td>
                                                          <td>{{item.comentario}}</td>
                                                          <td ng-if='(item.id_estado == 1)' >Aprobado</td>  
                                                          <td ng-if='(item.id_estado == 2)' >Rechazado</td>                                              
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

<!-- Inicio Jeremy Reyes B. - 2015-06-14-->
<div class="modal fade" id="filtro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Filtro</span></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
              <label>Desde:</label>                                               
                <div class="input-group date" id="datetimepicker3">                                               
                  <input type="text" 
                          class="form-control ng-pristine ng-valid ng-touched" 
                          placeholder="AAAA-MM-DD" 
                          id='dtpfechaInicio' 
                          ng-model='egresoVO.fechaInicio'>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
            </div>
            <div class="form-group">
              <label>Hasta:</label>                                               
                <div class="input-group date" id="datetimepicker2">                                               
                  <input type="text" 
                          class="form-control ng-pristine ng-valid ng-touched" 
                          placeholder="AAAA-MM-DD" 
                          id='dtpfechaFin' 
                          ng-model='egresoVO.fechaFin'>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
            </div>
            <div class="form-group">
              <label>Consecutivo:</label>                                               
              <input type="text" 
                      class="form-control ng-pristine ng-valid ng-touched" 
                      ng-model='egresoVO.consecutivo'>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label>Beneficiario:</label>
              <select class="form-control ng-pristine ng-valid ng-valid-required ng-touched" ng-model="egresoVO.beneficiario">
                <option value="">[Seleccione...]</option>
                @foreach($beneficiario as $row)
                <option value='[[$row->id]]'>[[$row->nombre ]]</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Concepto:</label>                                               
              <input type="text" 
                      class="form-control ng-pristine ng-valid ng-touched" 
                      ng-model='egresoVO.concepto'>
            </div>
            <div class="form-group">
              <label>Funcionario:</label>
              <select class="form-control" 
                      name="id_funcionario" 
                      size="1" 
                      id="id_funcionario"
                      ng-model="egresoVO.funcionario">
                <option value="">[Seleccione...]</option>
                @foreach($funcionario as $row)
                <option value='[[$row->id]]'>[[$row->persona->nombre_completo() ]]</option>
                @endforeach
              </select> 
            </div>
            <!--<div class="form-group">
              <label>Cuenta:</label>                                               
              <select class="form-control ng-pristine ng-valid ng-valid-required ng-touched"
                       ng-model="egresoVO.cuenta">
                <option value="">[Seleccione...]</option>
                @foreach($grandes_cuentas as $row)
                <option value='[[$row->id]]'>[[$row->nombre ]]</option>
                @endforeach
              </select>
            </div>-->
          </div>
        </div>                                   
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="consultaAvanzada(1)">Aceptar</button>
        </div>      
      </div>
    </div>          
  </div>
</div>
<!-- Fin Jeremy Reyes B. - 2015-06-14-->

 <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Comentario</h4>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                                              <div class="col-xs-8">
                                                  <label>Comentario:</label>
                                               </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-xs-12">
                                                 <textarea class="form-control" rows="4" cols="50" type="text" name="comentario" id="comentario"></textarea>
                                               </div>
                                            </div>  

                                                                    
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" ng-click='cambiar_estado()' data-dismiss="modal">Guardar</button>
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

