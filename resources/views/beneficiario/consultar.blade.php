 <!-- Page Heading -->
 <div class="row">
     <div class="col-lg-12">
             <h1 class="page-header">
            Beneficiario <small> / Consulta de beneficiario</small>
          </h1>
         <ol class="breadcrumb">
             <li><a ui-sref="home"><i class="icon-dashboard"></i> Inicio</a></li>             
             <li><a ui-sref='home.beneficiario'><i class="icon-dashboard"></i> Registrar</a></li>
             <li class="active"><i class="icon-dashboard"></i> Consultar</li>
         </ol>
     </div>
 </div>                
<div class="row" ng-init='consultar()'>
    <div class="panel panel-primary">
        
        <div class="panel-heading">
           <h3 class="panel-title">Consultar beneficiario</h3>
         </div>

         <div class="panel-body">
            
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <tr>
                       <th>Id</th>
                       <th>Nombre</th>
                       <th>Identificacion</th>
                       <th>Direccion</th>
                       <th>Telefono</th>
                       <th>Opciones</th>
                   </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='item in ListaBeneficiario.data'>
                            <td>{{item.id}}</td>
                            <td>{{item.nombre}}</td>
                            <td>{{item.identificacion}}</td>
                            <td>{{item.direccion}}</td>
                            <td>{{item.telefono}}</td>
                            <td><a ui-sref='home.editar_beneficiario({id:item.id})'><i class='fa fa-pencil fa-2x'></i></a>  </td>
                        </tr>
                    </tbody>
                </table>
            
              <div class="dataTables_paginate paging_simple_numbers col-lg-6">
              <ul class="pagination">
              <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultar(1)'>Inicio</a>
              </li>
              <li ng-if='!(ListaBeneficiario.current_page == 1)'
              style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultar(ListaBeneficiario.current_page - 1)'>Anterior</a>
              </li> 
              
             
              <li style='cursor:pointer;' ng-repeat='n in paginado'
              ng-class='ListaBeneficiario.current_page==n ? "active" : ""'>
                <a ng-click='consultar(n)'>{{n}}</a>
              </li>
              
              <li ng-if='!(ListaBeneficiario.current_page == ListaBeneficiario.last_page)'
              style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultar(ListaBeneficiario.current_page + 1)'>Siguiente</a>
              </li> 
              <li style='cursor:pointer;' tabindex="0" aria-controls="dataTables-example" class="paginate_button previous " id="dataTables-example_previous">
                <a ng-click='consultar(ListaBeneficiario.last_page)'>Fin</a>
               </li>
               
              </ul>
              </div>

         </div>
    </div>
</div>



