<!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
             <h1 class="page-header">
            Anticipos <small> / Registro de anticipos</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li><i class="icon-dashboard"></i> Anticipo</li>
            <li><a ui-sref='home.consultar_anticipo'><i class="icon-dashboard"></i> Consultar</a></li>
            <li ng-if="anticipoVO.id>0" class="active"><i class="icon-dashboard"></i> Editar</li>
         </ol>
     </div>
 </div> 
                <a href="" ui-sref="home.consultar_anticipo"><i class="fa fa-search fa-2x" tittle="consultar anticipos"></i></a>
                <br/><br/>
<div class="row">
          <div class="col-lg-12">
             <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Registro de Anticipos</h3>
              </div>
              <div class="panel-body">

                <div class="form-group">

                  
                  <div class="row">

                      <div class="col-lg-6">

                          <label>Fecha:</label>

                          <div class="input-group date" id='datetimepicker1'>                                               
                           <input class="form-control" type="text" name="fecha" class="tcal" id="dtfecha" required ng-model='anticipoVO.fecha'
                           />
                          <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                         </div>
                        

                          <p class="help-block">* Indique la fecha del anticipo.</p>

                          <label for="centro_costo">Centro Costo:</label>

                          <input class="form-control" type="text" name="centro_costo" id="centro_costo"  ng-model='anticipoVO.centro_costo'>

                          <p class="help-block">Indique el centro de costo.</p>

                          <label for="monto">Monto:</label>

                          <div class="form-group input-group">
		                      <span class="input-group-addon">$</span>
		                      <input class="form-control" type="text"  name="monto" id="monto"  required ng-model='anticipoVO.monto'>
		                      <span class="input-group-addon">.00</span>
		                 </div>

                          <p class="help-block">* Indique el monto.</p>

                          <label for="id_funcionario">Funcionario quien recibe:</label>

                          <select class="form-control" name="id_funcionario" size="1" id="id_funcionario" required ng-model='anticipoVO.id_funcionario_recibe'>

                          <option value="">[Seleccione...]</option>
                          @foreach($funcionarios as $row)
                          <option value='[[$row->id]]'>[[$row->persona->nombre_completo() ]]</option>
                          @endforeach
                           </select>

                           <p class="help-block">* escoja el funcionario.</p>

                      </div>

                      <div class="col-lg-6">

                           <!-- otro tab -->

                        <label>Entidad:</label>
                        <select class="form-control" id="banco" name="banco" required ng-model='anticipoVO.id_banco_destino'>
                         @foreach($bancos as $row)
                          <option value='[[$row->id]]'>[[$row->nombre ]]</option>
                          @endforeach
                        </select>

                            <p class="help-block">* Indique la entidad bancaria de la cuenta destino.</p>

                           <label for="numero_trans">Numero trans:</label>

                           <input class="form-control" type="text" name="numero_trans" id="numero_trans" ng-model='anticipoVO.numero_transaccion'>

                           <p class="help-block">Numero de la transaccion.</p>

                           <label for="observacion">Observacion:</label>

                           <textarea class="form-control" id="observacion" name="observacion" ng-model='anticipoVO.observacion'></textarea>

                           <p class="help-block">Observación adicional.</p>

                      </div>  

                    </div>

                    <input ng-if="anticipoVO.id==0 || anticipoVO.id==null " class="btn btn-primary"  type="button"  value="Guardar" ng-click='guardar()' />

                    <input ng-if="anticipoVO.id>0" class="btn btn-primary"  type="button"  value="Actualizar" ng-click='guardar()' />

                                   

                <br>

                </div>

              </div>

            </div>

          </div>

        </div><!-- fin de la fila -->


        <script type="text/javascript">
           $(function () {
           $('#datetimepicker1').datetimepicker({
               locale: 'es',
               format: 'DD-MM-YYYY'
           });

           

          
           });
      </script>