
@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

@include('alerts.success')
@include('alerts.error')

    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span>INSUMOS</h3>
        </div>
        <div class="panel-body">
            @if(Auth::user()->tipo == 'admin')
                <a href="/insumo/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo</a><br><br>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>IMAGEN</th>
                            <th>DESCRIPCION</th>
                            <th>MEDIDA</th>
                            <th>PRECIO COMPRA</th>
                            <th>PRECIO VENTA</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($insumos as $ins)
                        <tr>
                            <td>{{$ins->codigo}}</td>
                            @if($ins->imagen)
                                <td><img src="productos/{{$ins->imagen}}" width=50px></td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$ins->descripcion}}</td>
                            <td>{{$ins->unidad}}</td>
                            <td class="text-right"><b>{{$ins->precio_compra}} Bs.</b></td>
                            <td class="text-right"><b>{{$ins->precio_venta}} Bs.</b></td>
                            <td style="text-align:center;">
                                {!!link_to_route('insumo.edit', $title = 'Actualizar', $parameters = $ins->id, $attributes = ['class'=>'btn btn-sm btn-warning izquerda'])!!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
