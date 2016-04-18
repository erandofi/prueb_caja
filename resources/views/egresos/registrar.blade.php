<div class="row" ng-init="consultarPeriodo();consultarBeneficiario();">
   <div class="col-lg-12">
         <h1 class="page-header">
            Egresos <small> / Ingreso de egresos</small>
          </h1>
       <ol class="breadcrumb">
           <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li> 
           <li><a ui-sref="home.egresos"><i class="icon-dashboard"></i> Consultar</a></li>
           <li class="active"><i class="icon-dashboard"></i> Registrar Egreso</li>
       </ol>
   </div>
</div>          <a href="" ui-sref="home.egresos"><i class="fa fa-search fa-2x" tittle="consultar anticipos"></i></a>
                <br/><br/>              
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-6">
      <div class="panel panel-primary">        
        <div class="panel-heading">
          <h3 class="panel-title">Datos Generales</h3>
        </div>
        <div class="panel-body">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Periodo:</label>
              <select class="form-control "
                      ng-model="egresoVO.periodo">
                <option value="">[Seleccione...]</option>
                <option ng-repeat='item in ListaPeriodo' value='{{item.id}}'>{{item.nombre}} ({{item.nombres}} {{item.apellidos}})</option>
              </select>
              <p class="help-block">(*) Indique el periodo (caja) al que desea cargar el egreso.</p>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>Fecha</label>
              <div class="input-group date" id="datetimepicker1">                                               
                <input type="text" 
                        class="form-control " 
                        placeholder="AAAA-MM-DD" 
                        id='dtfechaInicio' 
                        ng-model='egresoVO.fecha'>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
              <p class="help-block">(*) Indique la fecha de utilizacion del servicio</p>
            </div>
          </div>
          <div class="col-lg-10">
            <div class="form-group">
              <label>Beneficiario:</label>
              <select class="form-control " 
                      ng-model="egresoVO.beneficiario">
                <option value="">[Seleccione...]</option>
                <option ng-repeat='item in ListaBeneficiario' value='{{item.id}}'>{{item.nombre}}</option>
              </select>
              <p class="help-block">(*) Indique la entidad que expide la factura.</p>
            </div>
          </div>
          <div class="col-lg-2">
            <br>
            <a style="cursor:pointer;line-height: 25px;" ng-click="abrirRegistroBeneficiario()">
              <i class="fa fa-2x fa-plus"></i>
            </a>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>Concepto:</label>
              <Textarea class="form-control "
                        ng-model="egresoVO.concepto"></Textarea>
              <p class="help-block">(*) Indique el concepto.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="panel panel-primary">        
        <div class="panel-heading">
          <h3 class="panel-title">Valores</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label>Subtotal</label>
            <div class="input-group date" id="">   
              <span class="input-group-addon">$</span>                                            
              <input type="text" 
                     class="form-control " 
                     placeholder="0"
                     ng-model="egresoVO.subtotal "
                     value="0"
                     numeric-only>
              <span class="input-group-addon">
                .00
              </span>
            </div>
            <p class="help-block">(*) Digite el valor del servicio</p>
          </div>
          <div class="form-group">
            <label>IVA</label>
            <div class="input-group date" id="">
              <span class="input-group-addon">$</span>                                               
              <input type="text" 
                     class="form-control " 
                     placeholder="0"
                     value="0"
                     ng-model="egresoVO.iva "
                     numeric-only>
              <span class="input-group-addon">
                .00
              </span>
            </div>
            <p class="help-block">(*) Digite el IVA del servicio</p>
          </div>
          <div class="form-group">
            <label>Retenciones</label>
            <div class="input-group date" id="">                                               
              <span class="input-group-addon">$</span>
              <input type="text" 
                     class="form-control " 
                     placeholder="0"
                     value="0" 
                     ng-model="egresoVO.retencion " 
                     numeric-only>
              <span class="input-group-addon">
                .00
              </span>
            </div>
            <p class="help-block">(*) Digite el valor de las retenciones</p>
          </div>
          <div class="form-group">
            <label>Total</label>
            <div class="input-group date" id="">     
              <span class="input-group-addon">$</span>                                          
              <input type="text" 
                     class="form-control " 
                     placeholder="0"
                     value="0"
                     ng-model="egresoVO.total "
                     numeric-only>
              <span class="input-group-addon">
                .00
              </span>
            </div>
            <p class="help-block">(*) Digite el valor total del servicio</p>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="col-lg-12">
      <div class="panel panel-primary">        
        <div class="panel-heading">
          <h3 class="panel-title">Funcionario y Observaciones</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label>Legalizado:</label>
                      <input type="checkbox" id="chequeado" >
          </div>
               <div id="oculto2" class="input-group" >
                    <div class="form-group">
                            <label>Funcionario:</label>
                            <select class="form-control" ng-model='balanceVO.funcionario'>
                                <option value="">[Seleccione...]</option>
                                
                                @foreach($funcionarios_2 as $fun)
                                     <option value="[[$fun->id]]">[[$fun->persona->nombre_completo()]] </option>
                                @endforeach

                            </select>
                            <p class="help-block">(*) Indique el funcionario que recibe el servicio.</p>
                   </div>
                 </div>  
                 <div id="oculto" class="input-group" style="display:none">
                        <div class="form-group">
                          <label>Funcionario:</label>
                          <select class="form-control" 
                                  name="id_funcionario" 
                                  size="1" 
                                  id="id_funcionario"
                                  ng-model="egresoVO.funcionario">
                            <option value="">[Seleccione...]</option>
                            @foreach($funcionarios as $row)
                            <option value='[[$row->id_funcionario]]'>[[$row->nombres]] [[$row->apellidos]]</option>
                            @endforeach
                           </select>            
                          <p class="help-block">(*) Indique el funcionario que recibe el servicio.</p>
                        </div>
                 </div>
           <div class="form-group">
              <label>Observaciones:</label>
              <Textarea class="form-control " ng-model="egresoVO.observacion"></Textarea>
            </div>
          </div>
        </div>
        <input class="btn btn-primary" type="button" value="Crear Egreso" ng-click="guardar()">
    </div>
    <div class="col-lg-6">
      <!--<div class="panel panel-primary">        
        <div class="panel-heading">
          <h3 class="panel-title">Referencia Contable</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label>Cuenta:</label>
            <select class="form-control "
                    ng-model="egresoVO.cuenta">
              <option value="">[Seleccione...]</option>
              @foreach($grandes_cuentas as $row)
              <option value='[[$row->id]]'>[[$row->nombre ]]</option>
              @endforeach
            </select>
            <p class="help-block">(*) Seleccione la cuenta.</p>
          </div>
        </div>
      </div>-->
      
    </div>
  </div>
</div>

<!-- Inicio Jeremy Reyes B. - 2015-06-14-->
<div class="modal fade" id="beneficiarioRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registro de Beneficiario</span></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Razon social:</label>
              <input class="form-control" required="" ng-model='egresoVO.nombre'>
              <p class="help-block">(*) Digite el nombre del beneficiario.</p> 
            </div>

            <div class="form-group">
              <label>Identificación:</label>
              <input class="form-control" required="" ng-model='egresoVO.identificacion'>
              <p class="help-block">(*) Digite la identificacióm del beneficiario.</p>
            </div>
            
            <div class="form-group">
              <label>Dirección:</label>
              <input class="form-control" required="" ng-model='egresoVO.direccion'>
            </div>

            <div class="form-group">
              <label>Telefono:</label>
              <input class="form-control" required="" ng-model='egresoVO.telefono'>
            </div> 

          </div>
        </div>                                   
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="guardarBeneficiario()">Registrar</button>
        </div>      
      </div>
    </div>          
  </div>
</div>

<script>
  $(document).ready(function(){
                       $("#chequeado").click(function(evento){
                          if ($("#chequeado").is(":checked")){
                             $("#oculto2").hide();
                             $("#oculto").show();
                          }else{
                             $("#oculto").hide();
                             $("#oculto2").show();
                          }
                       });
                    });
</script>
<!-- Fin Jeremy Reyes B. - 2015-06-14-->