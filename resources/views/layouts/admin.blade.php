<!DOCTYPE html>
<html lang="es">
<head>
      <title>SWAN</title>
      <meta charset="utf-8" >
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
      <meta name="description" content="">
  
      {!! Html::style('css/bootstrap.min.css') !!}
      {!! Html::style('css/bootstrap-datepicker.min.css') !!}
      {!! Html::style('css/font-awesome.min.css') !!}
      {!! Html::style('lib/datatables/css/buttons.dataTables.min.css') !!}
      {!! Html::style('css/main.css') !!}
      {!! Html::style('css/hover-min.css') !!}
      {!! Html::style('css/select2.min.css') !!}
      {!! Html::style('css/estilos.css') !!}
      {!! Html::style('css/sweetalert.css') !!}
</head>
<body>
    <!--div id="loading-ajax"></div-->
    <div id="loadingdiv" style="font-size:largest;">
	    <img class="loading" src="/img/loading.gif">
	</div>
    <div id="container" class="logo-off">

    <header>
          <div class="logo" id="logo"><h1>SWAN</h1></div>
          <div class="navbar navbar-default">
              <div class="container-fluid">
                  <div class="navbar-header pull-left">
                      <button class="navbar-toggle pull-left visible-xs toggle-menu" type="button">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <ul class="header-menu nav navbar-nav pull-left pull-left toggle-menu">
                          <li>
                              <a class="btn-banner  hide-menu hidden-xs active" href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Menú">
                                  <i class="fa fa-bars"></i>
                              </a>
                          </li>
                      </ul>
                  </div>
                  <div class="pull-right">
                    
                    <sub id="administracion">
                        <i class="fa fa-home"></i> ADMIN
                    </sub>  
                    <!--ul class="header-menu nav navbar-nav pull-left pull-left">
                        <li>
                            <a id="btn-banner" class="btn-banner hidden-xs" href="#" data-toggle="tooltip" data-placement="bottom" title="Ocultar banner">
                                <i class="fa fa-photo"></i>
                            </a>
                        </li>
                        <li>
                            <a id="btn-fullscreen" class="btn-fullscreen hidden-xs" href="#" data-toggle="tooltip" data-placement="bottom" title="Pantalla completa">
                                <i class="fa fa-expand"></i>
                                <i class="fa fa-compress"></i>
                            </a>
                        </li>
                    </ul-->
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </header>

<nav id="sidebar">
    <div class="navigation">
        <div class="user-data">
            <a href="/ajustes" title="Mi Cuenta">
            <div class="user-icon pull-left hvr-fade">
                <i class="fa fa-user"></i>
            </div>
            </a>
            <h4 class="user-details pull-left">
                {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}<br>
                
            </h4>
        </div>
        <div class="menu-title">
            &nbsp;
        </div>
        <ul class="list-unstyled">
            <li class="" id="bienadmin">
                <a href="/bienvenido">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Inicio</span>
                </a>
            </li>
            
            
            <li class="has-submenu">
                <a href="#">
                    <i class="fa fa-cogs"></i> 
                    <span class="nav-label">Producto</span>
                    <i class="fa fa-chevron-right pull-right"></i>
                </a>
                <ul class="list-unstyled">
                    <li class="" id="insumo">
                        <a href="/insumo">Listado</a>
                    </li>
                    <li class="" id="productocreate">
                        <a href="/insumo/create">Nuevo Producto</a>
                    </li>
                </ul>
            </li>
            
            
            <li class="has-submenu">
                <a href="#">
                    <i class="fa fa-google-wallet"></i> 
                    <span class="nav-label">Compras</span>
                    <i class="fa fa-chevron-right pull-right"></i>
                </a>
                <ul class="list-unstyled">
                    <li class="" id="ingreso">
                        <a href="/ingreso">Listado</a>
                    </li>
                    <li class="" id="ingresocreate">
                        <a href="/ingreso/create">Nueva Compra</a>
                    </li>
                </ul>
            </li>
           
            <li class="has-submenu">
                <a href="#">
                    <i class="fa fa-send"></i> 
                    <span class="nav-label">Ventas</span>
                    <i class="fa fa-chevron-right pull-right"></i>
                </a>
                <ul class="list-unstyled">
                    <li class="" id="egreso">
                        <a href="/egreso">Listado</a>
                    </li>
                    <li class="" id="egresocreate">
                        <a href="/solicitud/create">Nueva Venta</a>
                    </li>
                </ul>
            </li>
            
            <li class="has-submenu">
                <a href="#">
                    <i class="fa fa-exclamation"></i> 
                    <span class="nav-label">Retirados</span>
                    <i class="fa fa-chevron-right pull-right"></i>
                </a>
                <ul class="list-unstyled">
                    <li class="" id="egreso">
                        <a href="/retirado">Listado</a>
                    </li>
                    <li class="" id="egresocreate">
                        <a href="/retirado/create">Nuevo Retiro</a>
                    </li>
                </ul>
            </li>
            
            
            <li class="has-submenu">
                <a href="#">
                    <i class="fa fa-group"></i> 
                    <span class="nav-label">Usuarios</span>
                    <i class="fa fa-chevron-right pull-right"></i>
                </a>
                <ul class="list-unstyled">
                    <li class="" id="usuario">
                        <a href="/usuario">Listado</a>
                    </li>
                    <li class="" id="usuariocreate">
                        <a href="/usuario/create">Nuevo Usuario</a>
                    </li>
                    
                </ul>
            </li>
              
            <li>
                <a href="/logout">
                    <i class="fa fa-power-off"></i>
                    <span class="nav-label">Cerrar sesión</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
            <div class="container-fluid" id="container-main">
                <div id="anb-messages" class="anb-messages"></div>
                
                @yield('contenido')

            </div>
        </div>
        





        <footer class="footer text-center">
            <span class="center" style="mix-blend-mode: exclusion">&copy; 2017 Minimarket </span> v0.9 
            <a id="btn-scroll-top" class="btn-scroll-top" href="#">
                <i class="fa fa-chevron-up"></i>
            </a>
        </footer>


        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('js/bootstrap-datepicker.min.js') !!}
        {!! Html::script('js/select2.min.js') !!}
        {!! Html::script('lib/datatables/js/jquery.dataTables.min.js') !!}
        {!! Html::script('js/highcharts/highstock.js') !!}
        {!! Html::script('lib/datatables/js/dataTables.buttons.min.js') !!}
        {!! Html::script('lib/datatables/js/jszip.min.js') !!}
        {!! Html::script('lib/datatables/js/pdfmake.min.js') !!}
        {!! Html::script('lib/datatables/js/vfs_fonts.js') !!}
        {!! Html::script('lib/datatables/js/buttons.html5.min.js') !!}
        {!! Html::script('lib/datatables/js/buttons.print.min.js') !!}
        {!! Html::script('js/main.js') !!}
        {!! Html::script('js/scripts.js') !!}
        {!! Html::script('js/sweetalert.min.js') !!}
        
        @yield('scripts')
    </body>
</html>
