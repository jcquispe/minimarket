@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

@include('alerts.success')
@include('alerts.error')

    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> LISTADO DE PRODUCTOS RETIRADOS</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <a href="/retirado/create" class="btn btn-success" style="margin-bottom:5px;"><span class="glyphicon glyphicon-plus"></span> Registrar retiro de producto</a>    
                </div>
                <!--div class="col-md-5 text-right">
                    <label>Filtrar por fecha:</label> 
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="fecha" name="fecha" placeholder="01/01/2017">
                </div>
                <div class="col-md-1">
                    <input type="button" class="btn btn-default" name="ir" id="ir" value="Ir"/>
                </div-->
            </div>
            <?php //echo '<pre>';print_r(date('d/m/Y', strtotime($egresos[0]->fecha_solicitud)));die;?>
            <div class="table-responsive">
                <table class="table" id="retiradostable">
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>FECHA</th>
                            <th>PRODUCTO</th>
                            <th>DESCRIPCION</th>
                            <th>CANTIDAD</th>
                            <th>MOTIVO</th>
                            <th >ATENDIDO POR</th>
                            <th width=10%>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($retirados as $ret)
                        <tr>
                            <td>{{$ret->retirado}}</td>
                            <td class="text-center">{{date('d/m/Y', strtotime($ret->fecha_retirado))}}</td>
                            <td class="">{{$ret->codigo}}</td>
                            <td class="">{{$ret->descripcion}}</td>
                            <td>{{$ret->cantidad}}</td>
                            <td>{{$ret->motivo}}</td>
                            <td class="text-center">{{$ret->us}}</td>
                            <td>
                                <a href="/retirado/{{$ret->id}}/edit" class="btn btn-danger" title="Anular" style="float:left"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
