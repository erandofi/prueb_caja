 <!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
              <h1 class="page-header">
            Prestamo <small> / Actualizacion de prestamos</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li class="active"><i class="icon-dashboard"></i> Editar Prestamos</li>
            
         </ol>
     </div>
 </div>                
<div class="row">
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Editar Prestamo</h3>
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
                            <select class="form-control" required="" ng-model='prestamoVO.id_quien_presta'>
                                <option value="">[Seleccione...]</option>
                                
                             

                            </select>
                            <p class="help-block">(*)Seleccione el funcionario.</p>
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

                            


                            </select>
                            <p class="help-block">(*)Seleccione el periodo.</p>
                    </div>



                 <div class="panel-body">
                                <div class="row"><!--INICIO FILA-->
                                    <button class="btn btn-primary " type="button" id="btnActualizarPrestamo" ng-click='actualizar()'>{{ prestamoVO.id > 0 ? 'Actualizar' : 'Actualizar'  }}</button>
                                </div><!--FINAL FILA-->
                        </div>             
             </div>
         </div>
    </div>
</div>


 <script type="text/javascript">
           $(function () {
           $('#datetimepicker1, #datetimepicker2').datetimepicker({
               locale: 'es',
               format: 'DD-MM-YYYY'
           });

           $("#datetimepicker1, #datetimepicker2").on("dp.change",function (e) {
              //$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
           });

           });
</script>