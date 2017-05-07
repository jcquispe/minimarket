@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

@include('alerts.success')
@include('alerts.error')

    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> LISTADO DE VENTAS</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <a href="/solicitud/create" class="btn btn-success" style="margin-bottom:5px;"><span class="glyphicon glyphicon-plus"></span> Nueva venta</a>    
                </div>
                <div class="col-md-5 text-right">
                    <label>Filtrar por fecha:</label> 
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="fecha" name="fecha" placeholder="01/01/2017">
                </div>
                <div class="col-md-1">
                    <input type="button" class="btn btn-default" name="ir" id="ir" value="Ir"/>
                </div>
            </div>
            <?php //echo '<pre>';print_r(date('d/m/Y', strtotime($egresos[0]->fecha_solicitud)));die;?>
            <div class="table-responsive">
                <table class="table" id="ingresostable">
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>FECHA</th>
                            <th>COMPRADOR</th>
                            <th>IMPORTE TOTAL</th>
                            <th >ATENDIDO POR</th>
                            <th width=10%>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($egresos as $egr)
                        <tr>
                            <td>{{$egr->venta}}</td>
                            <td class="text-center">{{date('d/m/Y', strtotime($egr->fecha_egreso))}}</td>
                            <td class="total">{{$egr->ci}}</td>
                            <td class="total">{{$egr->total}} Bs.</td>
                            <td class="text-center">{{$egr->us}}</td>
                            <td>
                                <a href="/egreso/documento?cod={{$egr->id}}" class="btn btn-default" title="Ver PDF" style="float:left"><i class="fa fa-file-pdf-o"></i></a>
                                <a href="/egreso/{{$egr->id}}/edit" class="btn btn-danger" title="Anular" style="float:left"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
