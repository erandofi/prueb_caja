

 <!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
 <h1 class="page-header">
  Periodos <small> / Asociacion de consignación</small>
</h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li><a ui-sref="home.periodo"><i class="icon-dashboard"></i> Registrar</a></li>
             <li><a ui-sref='home.consultar_periodo'><i class="icon-dashboard"></i> Consultar</a></li>
             <li class="active"><i class="icon-dashboard"></i>Legalización</li>
         </ol>
     </div>
 </div>  
        <!--FIN DEL MENU-->
        <div class="row">
          <div class="col-lg-6">
             <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Anticipos registrados</h3>
              </div>
              <div class="panel-body" ng-init='consultarAnticipo()'>
               
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>
                       <th><input type="checkbox" ng-model='seleccionarTodos' ng-click='seleccionar_todo(seleccionarTodos)'></th>
                       <th>Fecha</th>
                       <th>Centro de costo</th>
                       <th>Monto</th>
                       <th>Funcionario quien recibe</th>
                       <th>Banco destino</th>
                   </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in ListaAnticipo.data'>
                            <th><input type="checkbox" ng-model='item.procesar'></th>
                            <td>{{item.fecha}}</td>
                            <td>{{item.centro_costo}}</td>
                            <td >{{item.monto | currency:'$':0}}</td>
                            <td>{{item.funcionario.persona.nombres}} {{item.funcionario.persona.apellidos}}</td>
                            <td>{{item.banco.nombre}}</td>
                          </tr>
                    </tbody>
                </table>
              <!--<div class="dataTables_paginate paging_simple_numbers col-lg-6">
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
              </div>-->

              <br>
              <input class="btn btn-primary" type="button" ng-click="legalizarAnticipo()" value="Ascosiar anticipo al periodo"/> 
             </div>
            </div>
           </div> 

            <div class="col-lg-6">
             <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Anticipos legalizados</h3>
              </div>
              <div class="panel-body">
                <div class="panel-body" ng-init='consultarAnticipoRegistrados()'>
               
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>
                       
                       <th>Fecha</th>
                       <th>Centro de costo</th>
                       <th>Monto</th>
                       <th>Funcionario quien recibe</th>
                       <th>Banco destino</th>
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
              <!--<div class="dataTables_paginate paging_simple_numbers col-lg-6">
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
              </div>-->
              
             </div>
             
             </div>
            </div>
           </div> 
            

           

            
        </div><!--FINAL DE FILA-->

        <script src="js/min/moment.min.js"></script>
        <script src="js/locale/es.js" ></script>
        <script src="js/bootstrap-datetimepicker.min.js" class="ng-scope"></script>
