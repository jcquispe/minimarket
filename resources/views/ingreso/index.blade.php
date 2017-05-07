@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

@include('alerts.success')
@include('alerts.error')

    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> LISTADO DE COMPRAS</h3>
        </div>
        <div class="panel-body">
            <a href="/ingreso/create" class="btn btn-success" style="margin-bottom:5px;"><span class="glyphicon glyphicon-plus"></span> Nueva compra</a>
            
            <div class="table-responsive">
                <table class="table" id="ingresostable">
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>FECHA</th>
                            <th>PROVEEDOR</th>
                            <th>FACTURA</th>
                            <th>TOTAL</th>
                            <th width=10%>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($ingresos as $ing)
                        <tr>
                            <td>{{$ing->compra}}</td>
                            <td class="text-center">{{date('d/m/Y', strtotime($ing->fecha_ingreso))}}</td>
                            <td>{{$ing->proveedor}}</td>
                            <td class="total">{{$ing->factura}}</td>
                            <td class="total">{{$ing->total}} Bs.</td>
                            <td class="text-center">
                                <!--a href="/ingreso/documento?cod={{$ing->id}}" class="btn btn-default" title="Ver PDF" style="float:left"><i class="fa fa-file-pdf-o"></i></a-->
                                <a href="/ingreso/{{$ing->id}}/edit" class="btn btn-danger" title="Anular" style="float:left"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
