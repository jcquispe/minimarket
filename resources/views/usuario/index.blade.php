@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

@include('alerts.success')
@include('alerts.error')

    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> LISTADO DE USUARIOS</h3>
        </div>
        <div class="panel-body">
            <a href="/usuario/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo</a><br><br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NOMBRE COMPLETO</th>
                            <th>USUARIO</th>
                            <th>ROL</th>
                            <th>VIGENTE</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $us)
                        <tr>
                            <td>{{$us->nombres.' '.$us->apellidos}}</td>
                            <td>{{$us->us}}</td>
                            @if($us->tipo=="admin")
                                <td>ADMINISTRADOR</td>
                            @else
                                <td>USUARIO</td>
                            @endif
                             @if($us->anulado==0)
                                <td><img src="img/yes.png" width=30></td>
                            @else
                                <td><img src="img/no.png" width=30></td>
                            @endif
                            <td>
                                {!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $us->id, $attributes = ['class'=>'btn btn-primary izquerda'])!!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   

@stop

