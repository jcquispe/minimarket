@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

@include('alerts.success')
@include('alerts.error')

    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span>SOLICITUDES</h3>
        </div>
        <div class="panel-body">
            <a href="/solicitud/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo</a><br><br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>FECHA</th>
                            <th>ESTADO</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $sol)
                        <tr>
                            <td>{{$sol->numero}}</td>
                            <td>{{$sol->fecha_solicitud}}</td>
                            <td>{{$sol->estado}}</td> 
                            <td>
                                <a href="/solicitud/documento?cod={{$sol->id}}" class="btn btn-default" title="Ver PDF" style="float:left"><i class="fa fa-file-pdf-o"></i></a>
                                @if($sol->estado == 'PENDIENTE')
                                    <a href="/solicitud/{{$sol->id}}/edit" class="btn btn-danger" title="Anular" style="float:left"><i class="fa fa-trash-o"></i></a>
                                @endif
                                
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

