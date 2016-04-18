

 <!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
           <h1 class="page-header">
            Periodo <small> / Registro de periodo</small>
          </h1>

         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li class="active"><i class="icon-dashboard"></i> Registrar</li>
            <li><a ui-sref='home.consultar_periodo'><i class="icon-dashboard"></i> Consultar</a></li>
         </ol>
     </div>
 </div>  

 <a href="" ui-sref="home.consultar_periodo"><i class="fa fa-search fa-2x" tittle="consultar anticipos"></i></a>
                <br/><br/>    
        <!--FIN DEL MENU-->
        <div class="row">
          <div class="col-lg-12">
             <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Creación de periodos y legalización</h3>
              </div>
              <div class="panel-body">
               <div class="col-sm-6">
                <form name="" id="form">
                  <div class="form-group">
                    <label>Nombre:</label>
                    <input class="form-control" required="" ng-model='periodoVO.nombre'>
                    <p class="help-block">(*)Digite el nombre del periodo.</p>
                  </div>
                  <div class="form-group">                  
                  <label>Responsable:</label>
                  <select class="form-control" ng-model='periodoVO.id_responsable'>
                    <option value="">[Seleccione...]</option>
                    @foreach($funcionarios as $row)
                      <option value='[[$row->id]]'>[[$row->persona->nombre_completo() ]]</option>
                    @endforeach
                  </select>
                  </div>

                  <div class="form-group">
                     <label>Fecha Inicio</label>
                     <div class="input-group date" id="datetimepicker1">                                               
                      <input type="text" class="form-control ng-pristine ng-valid ng-touched" 
                      placeholder="DD-MM-AAAA" id='dtfechaInicio' ng-model='periodoVO.fecha_inicio'>
                      <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                     </div>
                      <p>(*) Ingrese la fecha de inicio</p>
                   </div>

                   <div class="form-group">
                     <label>Fecha Fin</label>
                     <div class="input-group date" id="datetimepicker2">                                               
                      <input type="text" id='dtfechaFinal' class="form-control ng-pristine ng-valid ng-touched" 
                      placeholder="DD-MM-AAAA" ng-model='periodoVO.fecha_final'>
                      <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                     </div>
                      <p>(*) Ingrese la fecha final</p>
                   </div>
                   
                  <input class="btn btn-primary" type="button" value="{{ periodoVO.id > 0 ? 'Actualizar' : 'Registrar'  }}" ng-click='guardar()'/>
                    <div class="row"><!--FINAL DE FILA-->
                      <div class="col-lg-11">
                           

                     </div>
                    </div><!--FINAL DE FILA-->
              </form>
              <br>
              </div>
             </div>
            </div>
           </div>  
            

           

            
        </div><!--FINAL DE FILA-->

        <script src="js/min/moment.min.js"></script>
        <script src="js/locale/es.js" ></script>
        <script src="js/bootstrap-datetimepicker.min.js" class="ng-scope"></script>

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