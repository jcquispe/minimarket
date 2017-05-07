<!DOCTYPE html>
<html lang="es">
<head>
      <title>SIS-Almacen</title>
      <meta charset="utf-8" >
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
      <meta name="description" content="">
  
      {!! Html::style('css/bootstrap.min.css') !!}
      {!! Html::style('css/bootstrap-datepicker.min.css') !!}
      {!! Html::style('css/font-awesome.min.css') !!}
      {!! Html::style('lib/datatables/css/buttons.dataTables.min.css') !!}
      {!! Html::style('css/main.css') !!}
      {!! Html::style('css/hover-min.css') !!}
      {!! Html::style('css/select2.min.css') !!}
      
</head>
<body>
    <div id="loading-ajax"></div>
    <div id="container">

    <header>
          <div class="logo" id="logo"><h1>SIAA</h1></div>
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
                      <!--
                      <ul class="breadcrumb pull-left">
                          
                          <li class="active">Dashboard</li>
                    </ul>
                    -->
                    <ul class="header-menu nav navbar-nav pull-left pull-left">
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
                    </ul>
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
                {{ Auth::user()->nombre }} {{ Auth::user()->paterno }} {{ Auth::user()->materno }}<br>
                <sub id="administracion">
                    <i class="fa fa-home"></i> SOLICITUD
                </sub>
            </h4>
        </div>
        <div class="menu-title">
            &nbsp;
        </div>
        <ul class="list-unstyled">
            <li class="" id="biensolicitud">
                <a href="/biensolicitud">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Inicio</span>
                </a>
            </li>
           
            <li class="has-submenu">
                <a href="#">
                    <i class="fa fa-file-text"></i> 
                    <span class="nav-label">Solicitud</span>
                    <i class="fa fa-chevron-right pull-right"></i>
                </a>
                <ul class="list-unstyled">
                    <li class="" id="solicitud">
                        <a href="/solicitud">Listado</a>
                    </li>
                    <li class="" id="solicitudcreate">
                        <a href="/solicitud/create">Nueva Solicitud</a>
                    </li>
                </ul>
            </li>
            
            <li class="" id="insumo">
                <a href="/insumo">
                    <i class="fa fa-cubes"></i>
                    <span class="nav-label">Insumos</span>
                </a>
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
            <span class="center" style="mix-blend-mode: exclusion">&copy; 2016 <a href="#" target="_blank">Gobierno Autónomo Municipal de Achacachi</a> - <span class="hidden-xs">Todos los derechos reservados -</span> v1.0 </span>
            <a id="btn-scroll-top" class="btn-scroll-top" href="#">
                <i class="fa fa-chevron-up"></i>
            </a>
        </footer>
        
        
        

<!--div class="access" id="access">
    <ul class="access-menu">
        <li data-toggle="tooltip" data-placement="left" title="Nueva Solicitud"><a href="/solicitud/create" class="access-menu-item btn-success" data-option=""><i class="fa fa-cubes"></i></a></li>
    </ul>
    <button type="button" class="access-plus"  data-option="dashboardOption.do?id=0" data-toggle="tooltip" data-placement="left" title="Nuevo"><i class="fa fa-plus"></i></button>    
</div-->

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

        @yield('scripts')
    </body>
</html>
