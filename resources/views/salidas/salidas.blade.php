<!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
             <h1 class="page-header">
            Consignaciones  <small> / Consulta y registro de salidas</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home.inicio"><i class="icon-dashboard"></i> Inicio</a></li>
             <li class="active"><i class="icon-dashboard"></i> salidas</li>
         </ol>
     </div>
 </div>


<div class="bs-example" ng-init='activarventana="registro"'>
  <ul class="nav nav-tabs" style="margin-bottom: 15px;">
    <li class="active">
    	<a href="" ng-click='activarventana="registro"' data-toggle="tab">Registro</a></li>
    <li >
    	<a href="" ng-click='activarventana="consultar"' data-toggle="tab">Consulta</a></li>
  </ul>
  <div id="tab_salida" class="tab-content">
    <div class="tab-pane fade {{activarventana=='registro' ? 'active in' : ''}}" id="registro">
      
      <div class="col-lg-6">
		<form action="" method="post" enctype="multipart/form-data" style="" id="nueva_factura">
		    <label>Fecha:</label>
		    <div class="form-group input-group" id="datetimepicker1">
		        <!-- onclick="ocul_most_form('div_buscar_proyecto', true)" -->
		        <input ng-model="salidasVO.fecha" required id="fecha" name="fecha" class="form-control ng-pristine ng-valid ng-touched" placeholder="DD-MM-YYYY" type="text" value="" />
		        <span class="input-group-addon">
		        	<span class="glyphicon glyphicon-calendar"></span>
		        </span>
		    </div>
		    <p class="help-block">(*) Fecha en la que se desembolsa.</p>
		    <label>Monto:</label>
		    <div class="form-group input-group">
		        <input ng-model="salidasVO.monto" required id="monto" name="monto" class="form-control nuevo_factura" type="text">
		        <span class="input-group-addon">.00</span>
		    </div><p class="help-block">(*) Valor a desembolsar.</p>
		    <label>Entrega:</label>
		    <div class="form-group ">
		        <select ng-model="salidasVO.funcionario_envia" required id="entrega" name="entrega" class="form-control">
		        	<option value="">[Seleccionar...]</option>
		        	@foreach($funcionarios as $fun)
		        		<option value="[[$fun->id]]">[[$fun->persona->nombre_completo()]]</option>
		        	@endforeach
		        </select>
		        <p class="help-block">(*) Funcionario que desembolsa.</p>
		    </div>
		    <label>Periodo:</label>
		    <div class="form-group ">
		        <select ng-model="salidasVO.id_legalizacion" required id="periodo" name="periodo" class="form-control">
		        	<option value="">[Seleccionar...]</option>
		        	@foreach($legalizacion as $lgz)
		        		<option value="[[$lgz->id]]">[[$lgz->nombre]]</option>
		        	@endforeach
		        </select>
		        <p class="help-block">(*) Indique el periodo en el que se carga la consignación.</p>
		    </div>
		    <label>Recibe:</label>
		    <div class="form-group ">
		        <select ng-model="salidasVO.funcionario_recibe" required id="recibe" name="recibe" class="form-control">
		        	<option value="">[Seleccionar...]</option>
		        	@foreach($funcionarios as $fun)
		        		<option value="[[$fun->id]]">[[$fun->persona->nombre_completo()]]</option>
		        	@endforeach
		        </select>
		        <p class="help-block">(*) Funcionario que recibe.</p>
		    </div>
		    <label>Medio:</label>
		    <div class="form-group ">
		        <select ng-model="salidasVO.id_medio_consignacion" required id="medio" name="medio" class="form-control">
		        	<option value="">[Seleccionar...]</option>
		        	@foreach($medio_de_consignacion as $mdp)
		        		<option value="[[$mdp->id]]">[[$mdp->nombre]]</option>
		        	@endforeach
		        </select>
		        <p class="help-block">(*) Medio de entrega.</p>
		    </div>
		    <label>Referencia:</label>
		    <div class="form-group ">
		        <input ng-model="salidasVO.referencia" required id="referencia" name="referencia" class="form-control" type="text">
		        <p class="help-block">Dato de referencia para consultas.</p>
		    </div>
		    <div class="form-group ">
		        <button ng-click="guardar_salida()" id="" class="btn btn-primary" type="button" >Guardar</button>
		    </div>
		</form>
	  </div>

    </div>


    <div class="tab-pane fade {{activarventana=='consultar' ? 'active in' : ''}}" id="consulta" >
    	
		<form action="" method="post" style="" id="">
		<div class="row">
			<div class="col-lg-4">

				<label>Periodo:</label><br/>

			    <div class="form-group input-group" id="datetimepicker2" style="float: left;width: 161px;">
					<input ng-model="SconsultaVO.fdesde" id="c_desde" name="c_desde" class="form-control" type="text" placeholder="DD-MM-YYYY" value=""/>
					<span class="input-group-addon">
			        	<span class="glyphicon glyphicon-calendar"></span>
			        </span>
			    </div>

				<p style="float: left;">&nbsp;a&nbsp;</p>

				<div class="form-group input-group" id="datetimepicker3" style="width: 161px;">
					<input ng-model="SconsultaVO.fhasta" id="c_hasta" name="c_hasta" class="form-control" type="text" placeholder="DD-MM-YYYY" value=""/>
					<span class="input-group-addon">
			        	<span class="glyphicon glyphicon-calendar"></span>
			        </span>
				</div>

			</div>
			<div class="col-lg-4">

				<label>Entrega:</label>
				
			    <div class="form-group ">
			        <select ng-model="SconsultaVO.entrega" required id="c_entrega" name="c_entrega" class="form-control">
			        	<option value="">[Seleccionar...]</option>
			        	@foreach($funcionarios as $fun)
			        		<option value="[[$fun->id]]">[[$fun->persona->nombre_completo()]]</option>
			        	@endforeach
			        </select>
			    </div>

			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<label>Medio:</label>
			    <div class="form-group ">
			        <select ng-model="SconsultaVO.medio" required id="c_medio" name="c_medio" class="form-control">
			        	<option value="">[Seleccionar...]</option>
			        	@foreach($medio_de_consignacion as $mdp)
			        		<option value="[[$mdp->id]]">[[$mdp->nombre]]</option>
			        	@endforeach
			        </select>
			    </div>
			</div>
			<div class="col-lg-4">
				<label>Recibe:</label>
			    <div class="form-group ">
			        <select ng-model="SconsultaVO.recibe" required id="c_recibe" name="c_recibe" class="form-control">
			        	<option value="">[Seleccionar...]</option>
			        	@foreach($funcionarios as $fun)
			        		<option value="[[$fun->id]]">[[$fun->persona->nombre_completo()]]</option>
			        	@endforeach
			        </select>
			    </div>
			</div>


		</div>
		<div class="row">
			<div class="col-lg-4">
				<label>Periodo:</label>
			    <div class="form-group ">
			        <select ng-model="SconsultaVO.periodo" required  class="form-control">
			        	<option value="">[Seleccionar...]</option>
			        	@foreach($periodo as $per)
			        		<option value="[[$per->id]]">[[$per->nombre]]</option>
			        	@endforeach
			        </select>
			    </div>
			</div>
		</div>

		<div class="form-group ">
	        <button ng-click="consultar_salida()" id="" class="btn btn-primary" type="button" >Buscar</button>
	    </div>
		</form>

		<div class="row" style="padding: 0% 0% 0% 90%;">
	        <a href="salidas/salidas_excel"><i class="fa fa-print fa-3x" style="color:#31708F; cursor:pointer;"></i></a>
	    </div>

		<div class="row">
			<div class="col-lg-12">
				<br/><br/>
				<div class="table-responsive" ng-init="consultar_salida(1)">
				  <table class="table table-bordered table-hover table-striped tablesorter">
					<thead>
					  <tr>
						<th class="header">Fecha </th>
						<th class="header">Medio </th>
						<th class="header">Referencia </th>
						<th class="header">Entrega </th>
						<th class="header">Recibe </th>
						<th class="header">Monto </th>
						<th class="header">Opciones </th>
					  </tr>
					</thead>
					<tbody>
					  <tr ng-repeat='item in ListaSalida.data'>
						<td>{{item.fecha}}</td>
						<td>{{item.medio}}</td>
						<td>{{item.referencia}}</td>
						<td>{{item.funcionario_quienenvia}}</td>
						<td>{{item.funcionario_quienrecibe}}</td>
						<td>{{item.monto | currency:'$':0}}</td>
						<td><a ui-sref='home.salidas_editar({id:item.id})'><i class="fa fa-pencil fa-2x"></i></a>
							<a href="" ng-click="confirmar(item)" ><i class='fa fa-trash-o fa-2x'></i></a>
						</td>
					  </tr>
					</tbody>
				  </table>

				  <div class="dataTables_paginate paging_simple_numbers col-lg-6">
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
            	  </div>

				</div>
			</div>
		</div>
    </div>
  </div>
</div>

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

<script>
	$(function(){
		$('#datetimepicker1, #datetimepicker2, #datetimepicker3').datetimepicker({
			locale:'es',
			format:'DD-MM-YYYY'
		});
		
	});
</script>