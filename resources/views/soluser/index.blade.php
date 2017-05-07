@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

@include('alerts.success')
@include('alerts.error')

    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> SOLICITUD DE USUARIOS</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>CI</th>
                            <th>DEPENDENCIA</th>
                            <th>CORREO</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solusers as $us)
                        <tr>
                            <td>{{$us->nombre}}</td>
                            <td>{{$us->ci}}</td>
                            <td>{{$us->dependencia}}</td>
                            <td>{{$us->correo}}</td>
                            <td>
                                {!!link_to_route('soluser.edit', $title = 'Procesar', $parameters = $us->id, $attributes = ['class'=>'btn btn-primary izquerda'])!!}
                                {!!link_to_route('soluser.show', $title = 'Rechazar', $parameters = $us->id, $attributes = ['class'=>'btn btn-danger izquerda'])!!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@stop

