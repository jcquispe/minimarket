@extends('layouts.'.Auth::user()->tipo)

@include('alerts.success')

@section('contenido')
    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> LISTADO DE SOLICITUDES</h3>
        </div>
        <div class="panel-body">
            
            <div class="table-responsive">
                <table class="table" id="ingresostable">
                    <thead>
                        <tr>
                            <th>NUMERO</th>
                            <th>FECHA</th>
                            <th>SOLICITADO POR</th>
                            <th>PROGRAMA</th>
                            <th>ESTADO</th>
                            <th width=15%>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $sol)
                        <tr>
                            <td>{{$sol->numero}}</td>
                            <td>{{$sol->fecha_solicitud}}</td>
                            <td>{{$sol->us}}</td>
                            <td>{{$sol->cat_prog}}</td>
                            @if(date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a') <= 10)
                                <td><span class="label label-success">{{date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a')+1}} dias</span></td>'
                            @elseif(date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a') <= 30)
                                <td><span class="label label-warning">{{date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a')}} dias</span></td>'
                            @else
                                <td><span class="label label-danger">{{date_diff(date_create(date('Y-m-d')), date_create($sol->fecha_solicitud))->format('%a')}} dias</span></td>'
                            @endif   
                            <td><a href="/egreso/{{$sol->id}}/edit" class="btn btn-success btn-sm" title="Anular" style="float:left"><i class="fa fa-tag"></i> ATENDER</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@section('scripts')
<script>

    
    //
</script>
@stop