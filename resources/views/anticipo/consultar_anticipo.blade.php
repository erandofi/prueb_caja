<!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
              <h1 class="page-header">
            Anticipos <small> / Consulta de anticipos</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li ><a ui-sref='home.anticipo'><i class="icon-dashboard"></i> Anticipo</a></li>
            <li class="active"><i class="icon-dashboard"></i> Consultar</li>
         </ol>
     </div>
 </div> 

<div class="row">
  <div class="col-lg-12">
      
  </div>
</div> 
<div class="row">
    <div class="col-lg-12">
         <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Consulta de Anticipos</h3>
            </div>

            <div class="panel-body">
               <div class="col-lg-3">
                <label for="centro_costo">Centro Costo:</label>
                <input type="text" class="form-control" ng-model='criteriosVO.costo' ng-keyup="$event.keyCode==13 && consultar() ">
               </div>
               <div class="col-lg-3">
                <label for="centro_costo">Recibe:</label>
                <select class="form-control" name="id_funcionario" size="1" id="id_funcionario" required ng-model='criteriosVO.funcionario'>

                          <option value="">[Seleccione...]</option>
                          @foreach($funcionarios as $row)
                          <option value='[[$row->id]]'>[[$row->persona->nombre_completo() ]]</option>
                          @endforeach
                           </select>
               
                </div>
                 <div class="col-lg-2">
                    <label for="centro_costo">Desde:</label>
                    <div class="input-group date" id='datetimepicker2'>                                               
                           <input class="form-control" type="text"  class="tcal" id="desde"   ng-model='criteriosVO.desde'
                           />
                          <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                    </div>                
                </div>
                <div class="col-lg-2">
                    <label for="centro_costo">Hasta:</label>
                    <div class="input-group date" id='datetimepicker3'>                                               
                           <input class="form-control" type="text"  class="tcal" id="hasta" ng-model='criteriosVO.hasta'
                           />
                          <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                    </div>
                </div>
                <div class="col-lg-2"><br>                
                  <input class="btn btn-primary"  type="button"  value="Buscar" ng-click='consultar()'/>
                </div>


            </div>

            <div class="panel-body" ng-init="consultar()">

                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>
                       <th>Centro de costo</th>
                       <th>Fecha</th>
                       <th>Recibe</th>
                       <th>Banco</th>
                       <th>Numero de trans.</th>
                       <th>Monto</th>
                       <th>Observaciones</th>
                       <th>Opciones</th>
                   </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in ListaAnticipo.data'>
                            <td>{{item.centro_costo}}</td>
                            <td>{{item.fecha}}</td>
                            <td>{{item.nombre_completo}}</td>
                            <td>{{item.banco}}</td>
                            <td>{{item.numero_transaccion}}</td>
                            <td>{{item.monto | currency:'$':0}}</td>
                            <td>{{item.observacion}}</td>
                            <td><a ui-sref='home.anticipo_editar({id:item.id})'><i class='fa fa-pencil fa-2x'></i></a>
                                <a href="" ng-click="confirmar(item)" ><i class='fa fa-trash-o fa-2x'></i></a> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            
             <div class="dataTables_paginate paging_simple_numbers col-lg-6">
                <ul class="pagination">
                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                  <a ng-click='consultar(1)'>Inicio</a>
                </li>
                <li ng-if='!(ListaAnticipo.current_page == 1)'
                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                  <a ng-click='consultar(ListaAnticipo.current_page - 1)'>Anterior</a>
                </li> 
                
               
                <li style='cursor:pointer;' ng-repeat='n in paginado'
                ng-class='ListaAnticipo.current_page==n ? "active" : ""'>
                  <a ng-click='consultar(n)'>{{n}}</a>
                </li>
                
                <li ng-if='!(ListaAnticipo.current_page == ListaAnticipo.last_page)'
                style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                  <a ng-click='consultar(ListaAnticipo.current_page + 1)'>Siguiente</a>
                </li> 
                <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                  <a ng-click='consultar(ListaAnticipo.last_page)'>Fin</a>
                 </li>
                 
                </ul>
                </div>

            </div>
        </div>
    </div>
 </div><!-- fin de la fila -->


  <div id='modalConfirmar' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
      <div class="modal-dialog">
         <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Confirmar</h4>
             </div>


                  <div class="modal-body">
                       <div class="container-fluid">
                          <h3>Desea realmente eliminar este registro?</h3>                  
                          
                       </div>                  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" ng-click="eliminar(id_anticipo)" >Yes</button>
                  </div>
         </div>
      </div>
  </div>                  



 <script type="text/javascript">
           $(function () {
               $('#datetimepicker2').datetimepicker({
                   locale: 'es',
                   format: 'DD-MM-YYYY'
               });

               $('#datetimepicker3').datetimepicker({
                   locale: 'es',
                   format: 'DD-MM-YYYY'
               });

           

          
           });
      </script>