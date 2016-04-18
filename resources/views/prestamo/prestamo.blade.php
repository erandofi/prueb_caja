 <!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
              <h1 class="page-header">
            Prestamos <small> / Registro de prestamos</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li class="active"><i class="icon-dashboard"></i> Prestamos</li>
            
         </ol>
     </div>
 </div>                
<div class="row">
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Registrar</h3>
         </div>

         <div class="panel-body">
             <div class="col-lg-6">


                   <div class="form-group">
                       <label>Fecha</label>
                       <div class="input-group date" id="datetimepicker1">                                               
                           <input type="text" class="form-control ng-pristine ng-valid ng-touched" 
                           placeholder="DD-MM-AAAA" id='dtfechaInicio' ng-model='prestamoVO.fecha'>
                           <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                        </div>
                        <p>(*) Digite la fecha del prestamo</p>
                   </div>



                   <div class="form-group">
                            <label>Funcionario:</label>
                            <select class="form-control" required="required" ng-model='prestamoVO.id_quien_presta'>
                                <option value="">[Seleccione...]</option>
                                
                                @foreach($funcionarios as $fun)
                                     <option value="[[$fun->id]]">[[$fun->persona->nombre_completo()]] </option>
                                @endforeach

                            </select>
                            <p class="help-block">(*)Seleccione el funcionario que presta.</p>
                   </div>




                   <div class="form-group">
                            <label>Monto:</label>
                            <input class="form-control" required="" ng-model='prestamoVO.monto'>
                            <p class="help-block">(*)Digite monto del prestamo.</p>
                    </div>




                    <div class="form-group">
                            <label>Periodo:</label>
                            <select class="form-control" required="" ng-model='prestamoVO.id_legalizacion'>
                                <option value="">[Seleccione...]</option>

                               @foreach($legalizaciones as $leg)
                                     <option value="[[$leg->id]]">[[$leg->nombre]] </option>
                                @endforeach


                            </select>
                            <p class="help-block">(*)Seleccione el periodo.</p>
                    </div>



                 <div class="panel-body">
                                <div class="row"><!--INICIO FILA-->
                                    <button class="btn btn-primary " type="button" id="btnRegistrarPrestamo" ng-click='guardar()'>{{ prestamoVO.id > 0 ? 'Actualizar' : 'Registrar'  }}</button>
                                </div><!--FINAL FILA-->
                        </div>             
             </div>
         </div>
    </div>
</div>


<div class="row" ng-init='consultar()'>
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Prestamos</h3>
         </div>

         <div class="panel-body">

               <a href="prestamo/exportarexcel"><i class='fa fa-print fa-2x'></i></a> 
            
               <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>                       
                       <th>Periodo</th>
                       <th>Fecha</th>
                       <th>Funcionario</th>
                       <th>Monto</th>
                       <th>Opciones</th>
                   </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in ListaPrestamo.data'>
                            
                          
                            <td>{{item.nombre}}</td>
                            <th>{{item.fecha}}</th>
                            <td>{{item.nombres}} {{item.apellidos}}</td>
                            <td>{{item.monto | currency:'$':0}}</td>
                           
                            <td><a href="" ng-click='consultar_por_codigo(item)'><i class='fa fa-pencil fa-2x'></i></a>  </td>
                        </tr>
                    </tbody>
                </table>


              <div class="dataTables_paginate paging_simple_numbers col-lg-6">
              <ul class="pagination">
              <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultar(1)'>Inicio</a>
              </li>
              <li ng-if='!(ListaPrestamo.current_page == 1)'
              style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultar(ListaPrestamo.current_page - 1)'>Anterior</a>
              </li> 
              
             
              <li style='cursor:pointer;' ng-repeat='n in paginado'
              ng-class='ListaPrestamo.current_page==n ? "active" : ""'>
                <a ng-click='consultar(n)'>{{n}}</a>
              </li>
              
              <li ng-if='!(ListaPrestamo.current_page == ListaPrestamo.last_page)'
              style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultar(ListaPrestamo.current_page + 1)'>Siguiente</a>
              </li> 
              <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultar(ListaPrestamo.last_page)'>Fin</a>
               </li>
               
              </ul>
              </div>

            </div>
    </div>
</div>                


 <script type="text/javascript">
           $(function () {
           $('#datetimepicker1, #datetimepicker2').datetimepicker({
               locale: 'es',
               format: 'YYYY-MM-DD'
           });

           $("#datetimepicker1, #datetimepicker2").on("dp.change",function (e) {
              //$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
           });

           });
</script>