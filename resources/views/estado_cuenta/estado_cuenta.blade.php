  <div class="row">
     <div class="col-lg-12">
          <h1 class="page-header">
            Estado de cuenta <small> / Consulta de estado de la cuenta por funcionario</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>  
             <li class="active"><i class="icon-dashboard"></i> Estado de cuenta</li>
         </ol>
     </div>
 </div>                
<div class="row" ng-init='consultar_estadocuenta()' >
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Estado de cuenta</h3>
         </div>

         <div class="panel-body">
            <div class="form-group">
                            <label>Funcionario:</label>
                            <select class="form-control" ng-model='criteriosVO.funcionario'>
                                <option value="">[Seleccione...]</option>
                                @foreach($funcionarios as $fun)
                                     <option value="[[$fun->id]]">[[$fun->persona->nombre_completo()]] </option>
                                @endforeach

                            </select>
                   </div>
                   <div class="col-lg-2"><br>                
                  <input class="btn btn-primary"  type="button"  value="Buscar" ng-click='consultar_estadocuenta()'/>
                </div>
           <br/><br/>
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>
                       <th>Funcionario</th>
                       <th>Total salidas</th>
                       <th>Total egresos</th>
                       <th>Por legalizar</th>
                       <th>Detalles</th>
                   </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in ListaEstadocuenta.data' >
                            <td>{{item.funcionario}}</td>
                            <td>{{item.salidas | currency:'$':0}}</td>
                            <td>{{item.egresos | currency:'$':0}}</td>
                            <td>{{item.por_legalizar | currency:'$':0}}</td>
                            <td><a ui-sref='home.estadodecuentadetalle({id:item.id,idrecibe:item.funcionario_recibe})'><i class="fa fa-ellipsis-h fa-2x" ></i></a></td>
                    </tbody>
                </table>
                <div class="dataTables_paginate paging_simple_numbers col-lg-6">
                <ul class="pagination">
                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                  <a ng-click='consultar(1)'>Inicio</a>
                </li>
                <li ng-if='!(ListaEstadocuenta.current_page == 1)'
                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                  <a ng-click='consultar(ListaEstadocuenta.current_page - 1)'>Anterior</a>
                </li> 
                
               
                <li style='cursor:pointer;' ng-repeat='n in paginado'
                ng-class='ListaEstadocuenta.current_page==n ? "active" : ""'>
                  <a ng-click='consultar(n)'>{{n}}</a>
                </li>
                
                <li ng-if='!(ListaEstadocuenta.current_page == ListaEstadocuenta.last_page)'
                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                  <a ng-click='consultar(ListaEstadocuenta.current_page + 1)'>Siguiente</a>
                </li> 
                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                  <a ng-click='consultar(ListaEstadocuenta.last_page)'>Fin</a>
                 </li>
                 
                </ul>
              </div>
         </div>
    </div>
</div>

