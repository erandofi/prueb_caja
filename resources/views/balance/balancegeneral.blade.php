  <div class="row">
     <div class="col-lg-12">
          <h1 class="page-header">
            Balance General <small> / Consulta de balance</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>  
             <li class="active"><i class="icon-dashboard"></i> Balance General</li>
         </ol>
     </div>
 </div>                
<div class="row" ng-init='consultar()' >
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Balance General</h3>
         </div>

         <div class="panel-body">
            <i class="fa fa-filter fa-2x" data-toggle="modal" data-target="#miventana" style="cursor:pointer;"> </i> 
           <a href="balance/reporte"> <i class="fa fa-print fa-2x"></i></a>
           <br/><br/>
            
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>
                       <th>Periodo</th>
                       <th>Funcionario</th>
                       <th>Saldo Anterior</th>
                       <th>Total Consignacion</th>
                       <th>Total Giros</th>
                       <th>Gastos Propios</th>
                       <th>Prestamos</th>
                       <th>Total Egresos</th>
                       <th>En Caja</th>
                   </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in ListaBalance' >
                            <td>{{item.periodo}}</td>
                            <td>{{item.nombre}}</td>
                            <td>{{item.saldo_anterior | currency:'$':0}}</td>
                            <td>{{item.total_monto | currency:'$':0}}</td>
                            <td>{{item.total_entregado | currency:'$':0}}</td>
                            <td>{{item.gastos_propios | currency:'$':0}}</td>
                            <td>{{item.prestamo | currency:'$':0}}</td>
                            <td>{{item.egresos | currency:'$':0}}</td>
                            <td ng-if="item.en_caja<0"><font color="#FF0000">{{item.en_caja | currency:'$':0}}</font></td>
                            <td ng-if="item.en_caja>=0">{{item.en_caja | currency:'$':0}}</td>
                        </tr>
                       
                    </tbody>
                    <tfoot>
                         <tr ng-repeat='item2 in TotalBalance'>
                          <td colspan="3" align="center">Total</td>
                          <td>{{item2.total_anticipo | currency:'$':0}}</td>
                          <td>{{item2.total_entregado | currency:'$':0}}</td>
                          <td>{{item2.gastos_propios | currency:'$':0}}</td>
                          <td>{{item2.total_presamos | currency:'$':0}}</td>
                          <td>{{item2.total_egresos | currency:'$':0}}</td>
                          <td ng-if="item2.total_caja<0"><font color="#FF0000">{{item2.total_caja | currency:'$':0}}</font></td>
                          <td ng-if="item2.total_caja>=0">{{item2.total_caja | currency:'$':0}}</td>
                        <tr>
                    </tfoot>
                </table>
         </div>
    </div>
</div>

<script>
  $(document).ready(function(){
                       $("#chequeado").click(function(evento){
                          if ($("#chequeado").is(":checked")){
                             $("#oculto").show();
                          }else{
                             $("#oculto").hide();
                          }
                       });
                    });
</script>




<div class="modal fade" id="miventana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Filtro</h3>
                  </div>
                  <div class="modal-body">
                     <div class="form-group">
                            <label>Año:</label>
                            <input class="form-control" style="width:100px" ng-model="balanceVO.ano" id="ano">
                    </div>
                    <div class="form-group">
                            <label>Periodo:</label>
                            <input class="form-control"  placeholder="Digite el nombre del periodo aquí..."ng-model="balanceVO.periodo" id="periodo">
                    </div>
                     <div class="form-group">
                            <label><input type="checkbox" id="chequeado">  Especifico</label>
                    </div>
                  <div id="oculto" class="input-group" style="display:none">
                    <div class="form-group">
                            <label>Funcionario:</label>
                            <select class="form-control" ng-model='balanceVO.funcionario'>
                                <option value="0">[Seleccione...]</option>
                                
                                @foreach($funcionarios as $fun)
                                     <option value="[[$fun->id]]">[[$fun->persona->nombre_completo()]] </option>
                                @endforeach

                            </select>
                   </div>
                 </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="consultar()">Aplicar</button>
                  </div>
                </div>

              </div>

            </div>