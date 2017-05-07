@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

      <div class="starter-template">
        <h3>Bienvenido</h3>
        <div class="row">
          <div class="col-md-4" id="porcent"></div>
          <div class="col-md-8" id="media"></div>
        </div>  
      <div class="row">
        <div class="col-md-12">
          <h4>Insumos Disponibles</h4>
              <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DESCRIPCION</th>
                            <th>UNIDAD</th>
                            <th>DISPONIBLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($disponible as $disp)
                        <tr>
                            <td>{{$disp[0]}}</td>
                            <td>{{$disp[1]}}</td>
                            <td>{{$disp[2]}}</td>
                            @if($disp[3]<= 10)
                                <td><span class="label label-danger">{{$disp[3]}} en almacen</span></td>'
                            @elseif($disp[3] <= 30)
                                <td><span class="label label-warning">{{$disp[3]}} en almacen</span></td>'
                            @else
                                <td><span class="label label-success">{{$disp[3]}} en almacen</span></td>'
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
        </div>
      </div>    
      
@stop

@section('scripts')
  {!! Html::script('js/highcharts/highcharts.js') !!}
  {!! Html::script('js/highcharts/exporting.js') !!}
  <script type="text/javascript">
    $(document).ready(function(){
        $('#media').highcharts({
          title: {
              text: 'Gobierno Autonomo Municipal de Achacachi',
              x: -20 //center
          },
          subtitle: {
              text: 'Fuente: Unidad de Almacenes',
              x: -20
          },
          xAxis: {
              categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                  'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
          },
          yAxis: {
              title: {
                  text: 'Cantidad de solicitudes'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          tooltip: {
              valueSuffix: ' Sol.'
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
          },
          series: [{
              name: 'Solicitudes',
              data: [<?php echo $solGestion[0];?>, <?php echo $solGestion[1];?>, <?php echo $solGestion[2];?>, <?php echo $solGestion[3];?>, <?php echo $solGestion[4];?>, <?php echo $solGestion[5];?>, <?php echo $solGestion[6];?>, <?php echo $solGestion[7];?>, <?php echo $solGestion[8];?>, <?php echo $solGestion[9];?>, <?php echo $solGestion[10];?>, <?php echo $solGestion[11];?>]
          }]
      });
      
      
      $('#porcent').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Solicitud Almacen'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Procesadas',
                colorByPoint: true,
                data: [{
                    name: 'Atendidas',
                    y: <?php echo $ates;?>,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Rechazadas',
                    y: <?php echo $recs;?>
                }, {
                    name: 'Pendientes',
                    y: <?php echo $pens;?>
                }]
            }]
        });
    });
  </script>
@stop