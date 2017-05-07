@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

      <div class="starter-template">
        <h3>Bienvenido</h3>
      </div>
      <div class="row">
        <div class="col-md-8" id="chart"></div>
        <div class="col-md-4" id="cant"></div>
      </div>
      
      <div class="row">
          <div class="col-md-8">
              <h4>Solicitudes recientes</h4>
              <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>COD</th>
                            <th>FECHA</th>
                            <th>SOLICITADO POR</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $sol)
                        <tr>
                            <td>{{$sol->numero}}</td>
                            <td>{{$sol->fecha_solicitud}}</td>
                            <td>{{$sol->us}}</td>
                            @if(date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a') <= 10)
                                <td><span class="label label-success">{{date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a')+1}} dias</span></td>'
                            @elseif(date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a') <= 30)
                                <td><span class="label label-warning">{{date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a')}} dias</span></td>'
                            @else
                                <td><span class="label label-danger">{{date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a')}} dias</span></td>'
                            @endif   
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <a href="/egreso/solicitudes">Ver todas</a>
          </div>
          <div class="col-md-4" id="porcent"></div>
      </div>
@stop

@section('scripts')
  {!! Html::script('js/highcharts/highcharts.js') !!}
  {!! Html::script('js/highcharts/exporting.js') !!}
  <script type="text/javascript">
    $(document).ready(function(){
        $('#chart').highcharts({
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
                  text: 'Inversión (Bs.)'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          tooltip: {
              valueSuffix: 'Bs'
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
          },
          series: [{
              name: 'Ingresos',
              data: [<?php echo $totGestion[0];?>, <?php echo $totGestion[1];?>, <?php echo $totGestion[2];?>, <?php echo $totGestion[3];?>, <?php echo $totGestion[4];?>, <?php echo $totGestion[5];?>, <?php echo $totGestion[6];?>, <?php echo $totGestion[7];?>, <?php echo $totGestion[8];?>, <?php echo $totGestion[9];?>, <?php echo $totGestion[10];?>, <?php echo $totGestion[11];?>]
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
                    y: <?php echo $ate;?>,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Rechazadas',
                    y: <?php echo $rec;?>
                }, {
                    name: 'Pendientes',
                    y: <?php echo $pen;?>
                }]
            }]
        });

    $('#cant').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Actividad Trimestral'
        },
        subtitle: {
            text: 'Fuente: Sistema SIAA'
        },
        xAxis: {
            categories: [
                'Ene-Mar',
                'Abr-Jun',
                'Jul-Sep',
                'Oct-Dic'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad (u)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} u</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ingresos',
            data: [<?php echo $ing[0];?>, <?php echo $ing[1];?>, <?php echo $ing[2];?>, <?php echo $ing[3];?>]

        }, {
            name: 'Egresos',
            data: [<?php echo $egr[0];?>, <?php echo $egr[1];?>, <?php echo $egr[2];?>, <?php echo $egr[3];?>]

        }, {
            name: 'Solicitud',
            data: [<?php echo $soli[0];?>, <?php echo $soli[1];?>, <?php echo $soli[2];?>, <?php echo $soli[3];?>]

        }]
    });
});
  </script>
@stop