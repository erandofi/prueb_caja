<div id="wrapper">

 <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" ui-sref="home.inicio">Aplicaciones</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
            
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!--<li>
                            <a href=""><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>-->
                        <li>
                            <a href='' ><i class="fa fa-fw fa-power-off"></i> Salir</a>
                            <!--<a href='' onclick="window.close();" ><i class="fa fa-fw fa-power-off"></i> Salir</a>-->
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse" ng-init='consultarmenu()'>
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a ui-sref="home.inicio"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
			<div class="container-fluid">
		     
                <!--Aqui angular nos va a renderizar las vitas deseamos ver-->

                <div class="col-lg-3">

            <div class="panel panel-info"  style="cursor:pointer"  ui-sref="home.inicio">

              <div class="panel-heading">

                <div class="row">

                  <div class="col-xs-6">

                    <i class="fa fa-money fa-5x"></i>

                  </div>

                  <div class="col-xs-6 text-right">

                    <p class="announcement-heading"></p>

                    <p class="announcement-text">Caja.<br/><br/></p>

                  </div>

                </div>

              </div>

              <a  ui-sref="login">

                <div class="panel-footer announcement-bottom">

                  <div class="row">

                    <div class="col-xs-6">
                      Caja
                    </div>

                    <div class="col-xs-6 text-right">

                      <i class="fa fa-arrow-circle-right"></i>

                    </div>

                  </div>

                </div>

              </a>

            </div>

          </div> 

          <div class="col-lg-3">

            <div class="panel panel-info"  style="cursor:pointer"  ui-sref="home.salidas">

              <div class="panel-heading">

                <div class="row">

                  <div class="col-xs-6">

                    <i class="fa fa-graduation-cap fa-5x"></i>

                  </div>

                  <div class="col-xs-6 text-right">

                    <p class="announcement-heading"></p>

                    <p class="announcement-text">Formaciones.<br/><br/></p>

                  </div>

                </div>

              </div>

              <a  ui-sref="home.salidas">

                <div class="panel-footer announcement-bottom">

                  <div class="row">

                    <div class="col-xs-6">
                      Formaciones
                    </div>

                    <div class="col-xs-6 text-right">

                      <i class="fa fa-arrow-circle-right"></i>

                    </div>

                  </div>

                </div>

              </a>

            </div>

          </div> 
                

			  </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->