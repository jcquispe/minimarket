@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

  <div class="starter-template">
    <h1>Bienvenido</h1>
   	<a href="mailto:subastas@aduana.gob.bo?Subject=Comentarios" id="Correo" >Env&iacute;enos sus comentarios</a>
    <div class="row">
      	<div class="col-md-6" id="repus"></div>
      	<div class="col-md-6" id="media">
            <div class="col-md-6 center" id="conectados">
                <i class="fa fa-user"></i> Usuarios conectados:
                <h1 style="color:#853655"><?php echo $conecNow;?></h1>
            </div> 
            <div class="col-md-6 center" id="visitas">
                <i class="fa fa-group"></i> Visitas al sistema:
                <h1 style="color:#F33F50"><?php echo $conecAll;?></h1>
            </div>
            <div class="col-md-12">
                
            </div>
        </div>
        <div class="col-md-12" id="conec"></div>
    </div>  
  </div>

@stop

@section('scripts')
  {!! Html::script('js/highcharts/highcharts.js') !!}
  {!! Html::script('js/highcharts/exporting.js') !!}
      
  <script type="text/javascript">
    $(document).ready(function(){
           
        if (!Highcharts.theme) {
            Highcharts.setOptions({
                colors: ['#35B397', '#853655', '#F33F50', '#FFB84A', '#002C41']
            });
        }    

        $('#conec').highcharts({
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
                  text: 'Usuarios conectados'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          tooltip: {
              valueSuffix: 'usuarios'
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
          },
          series: [{
              name: 'Usuarios',
              data: [<?php echo $totConec[0];?>, <?php echo $totConec[1];?>, <?php echo $totConec[2];?>, <?php echo $totConec[3];?>, <?php echo $totConec[4];?>, <?php echo $totConec[5];?>, <?php echo $totConec[6];?>, <?php echo $totConec[7];?>, <?php echo $totConec[8];?>, <?php echo $totConec[9];?>, <?php echo $totConec[10];?>, <?php echo $totConec[11];?>]
          }]
      });

        $("#repus").highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Usuarios<br>habilitados<br>SIAA',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            innerSize: '50%',
            data: [
                ['Admin',   <?php echo $admin;?>],
                ['Almacen',       <?php echo $almacen;?>],
                ['Solicitud', <?php echo $solicitud;?>],
                ['Inactivos',    <?php echo $anulados;?>],
                {
                    name: 'Generado por SIAA',
                    y: 0.2,
                    dataLabels: {
                        enabled: false
                    }
                }
            ]
        }]
      });
    
    });
</script>
@stop