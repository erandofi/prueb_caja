  <div class="row">
     <div class="col-lg-12">
          <h1 class="page-header">
            Estado de cuenta <small> / Consulta de estado de la cuenta por funcionario</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li><a ui-sref="home.estadodecuenta"><i class="icon-dashboard"></i> Estado de cuenta</a></li>  
             <li class="active"><i class="icon-dashboard"></i> Detalle</li>
         </ol>
     </div>
 </div>                
<div class="row" ng-init='consultar_por_codigo()' >
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Detalle de estado de cuenta</h3>
         </div>

         <div class="panel-body">
             <div class="bs-example" ng-init='activarventana="registro"' >
                                <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                  <li class="active">
                                    <a href="" ng-click='activarventana="registro"' data-toggle="tab">Consulta de salidas</a></li>
                                  <li >
                                    <a href="" ng-click='activarventana="consultar"' data-toggle="tab">Consulta de egresos</a></li>
                                </ul>
                                <div id="tab_salida" class="tab-content">
                                  <div class="tab-pane fade {{activarventana=='registro' ? 'active in' : ''}}" id="registro">
                                    
                                    <div class="row">
                                    <div class="col-lg-12">
                                      <br/><br/>
                                      <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped tablesorter">
                                        <thead>
                                          <tr>
                                          <th class="header">Fecha</th>
                                          <th class="header">Funcionario quien entrego</th>
                                          <th class="header">Medio</th>
                                          <th class="header">Monto </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr ng-repeat='item in ListaSalida'>
                                          <td>{{item.fecha}}</td>
                                          <td>{{item.entrega.persona.nombres}} {{item.entrega.persona.apellidos}}</td>
                                          <td>{{item.medio.nombre}}</td>
                                          <td>{{item.monto | currency:'$':0}}</td>
                                          </tr>
                                        </tbody>
                                        </table>
                              
                                        <!-- <div class="dataTables_paginate paging_simple_numbers col-lg-6">
                                                <ul class="pagination">
                                                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(1)'>Inicio</a>
                                                </li>
                                                <li ng-if='!(ListaSalida.current_page == 1)'
                                                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.current_page - 1)'>Anterior</a>
                                                </li> 
                                                
                                               
                                                <li style='cursor:pointer;' ng-repeat='n in paginado'
                                                ng-class='ListaSalida.current_page==n ? "active" : ""'>
                                                  <a ng-click='consultar_salida(n)'>{{n}}</a>
                                                </li>
                                                
                                                <li ng-if='!(ListaSalida.current_page == ListaSalida.last_page)'
                                                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.current_page + 1)'>Siguiente</a>
                                                </li> 
                                                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.last_page)'>Fin</a>
                                                 </li>
                                                 
                                                </ul>
                                              </div>  -->
                              
                                      </div>
                                    </div>
                                  </div>
                              
                                  </div>
                              
                              
                                  <div class="tab-pane fade {{activarventana=='consultar' ? 'active in' : ''}}" id="consulta" >
                              
                              
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <br/><br/>
                                      <div class="table-responsive" >
                                        <table class="table table-bordered table-hover table-striped tablesorter">
                                        <thead>
                                          <tr>
                                          <th class="header">Fecha </th>
                                          <th class="header">Monto </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr ng-repeat='item in ListaEgreso'>
                                              <td>{{item.fecha}}</td>
                                              <td>{{item.total}}</td>
                                          </tr>
                                        </tbody>
                                        </table>
                              
                                        <!-- <div class="dataTables_paginate paging_simple_numbers col-lg-6">
                                                <ul class="pagination">
                                                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(1)'>Inicio</a>
                                                </li>
                                                <li ng-if='!(ListaSalida.current_page == 1)'
                                                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.current_page - 1)'>Anterior</a>
                                                </li> 
                                                
                                               
                                                <li style='cursor:pointer;' ng-repeat='n in paginado'
                                                ng-class='ListaSalida.current_page==n ? "active" : ""'>
                                                  <a ng-click='consultar_salida(n)'>{{n}}</a>
                                                </li>
                                                
                                                <li ng-if='!(ListaSalida.current_page == ListaSalida.last_page)'
                                                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.current_page + 1)'>Siguiente</a>
                                                </li> 
                                                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.last_page)'>Fin</a>
                                                 </li>
                                                 
                                                </ul>
                                              </div>  -->
                              
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                </div>
                              </div>


         </div>
    </div>
</div>



<div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content" >
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Detalle</h3>
                  </div>
                  <div class="modal-body">
                        <div class="bs-example" >
                                <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                  <li class="active">
                                    <a href="" ng-click='activarventana="registro"' data-toggle="tab">Consulta de salidas</a></li>
                                  <li >
                                    <a href="" ng-click='activarventana="consultar"' data-toggle="tab">Consulta de egresos</a></li>
                                </ul>
                                <div id="tab_salida" class="tab-content">
                                  <div class="tab-pane fade {{activarventana=='registro' ? 'active in' : ''}}" id="registro">
                                    
                                    <div class="row">
                                    <div class="col-lg-12">
                                      <br/><br/>
                                      <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped tablesorter">
                                        <thead>
                                          <tr>
                                          <th class="header">Monto </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr ng-repeat='item in ListaSalida.data'>
                                          <td>{{item.monto | currency:'$':0}}</td>
                                          </tr>
                                        </tbody>
                                        </table>
                              
                                        <!-- <div class="dataTables_paginate paging_simple_numbers col-lg-6">
                                                <ul class="pagination">
                                                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(1)'>Inicio</a>
                                                </li>
                                                <li ng-if='!(ListaSalida.current_page == 1)'
                                                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.current_page - 1)'>Anterior</a>
                                                </li> 
                                                
                                               
                                                <li style='cursor:pointer;' ng-repeat='n in paginado'
                                                ng-class='ListaSalida.current_page==n ? "active" : ""'>
                                                  <a ng-click='consultar_salida(n)'>{{n}}</a>
                                                </li>
                                                
                                                <li ng-if='!(ListaSalida.current_page == ListaSalida.last_page)'
                                                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.current_page + 1)'>Siguiente</a>
                                                </li> 
                                                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.last_page)'>Fin</a>
                                                 </li>
                                                 
                                                </ul>
                                              </div>  -->
                              
                                      </div>
                                    </div>
                                  </div>
                              
                                  </div>
                              
                              
                                  <div class="tab-pane fade {{activarventana=='consultar' ? 'active in' : ''}}" id="consulta" >
                              
                              
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <br/><br/>
                                      <div class="table-responsive" >
                                        <table class="table table-bordered table-hover table-striped tablesorter">
                                        <thead>
                                          <tr>
                                          <th class="header">Fecha </th>
                                          <th class="header">Medio </th>
                                          <th class="header">Referencia </th>
                                          <th class="header">Entrega </th>
                                          <th class="header">Recibe </th>
                                          <th class="header">Monto </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                             
                          
                                          </tr>
                                        </tbody>
                                        </table>
                              
                                        <!-- <div class="dataTables_paginate paging_simple_numbers col-lg-6">
                                                <ul class="pagination">
                                                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(1)'>Inicio</a>
                                                </li>
                                                <li ng-if='!(ListaSalida.current_page == 1)'
                                                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.current_page - 1)'>Anterior</a>
                                                </li> 
                                                
                                               
                                                <li style='cursor:pointer;' ng-repeat='n in paginado'
                                                ng-class='ListaSalida.current_page==n ? "active" : ""'>
                                                  <a ng-click='consultar_salida(n)'>{{n}}</a>
                                                </li>
                                                
                                                <li ng-if='!(ListaSalida.current_page == ListaSalida.last_page)'
                                                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.current_page + 1)'>Siguiente</a>
                                                </li> 
                                                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                                                  <a ng-click='consultar_salida(ListaSalida.last_page)'>Fin</a>
                                                 </li>
                                                 
                                                </ul>
                                              </div>  -->
                              
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                </div>
                              </div>      
 
                   </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="consultar()">Aplicar</button>
                  </div>
                </div>

              </div>

  </div>