@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

<div class="panel panel-default cuadro">
      <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> ANULAR VENTA</h3>
      </div>
      <div class="panel-body">

        
        <form action="/egreso/anular" method="post" class="form-horizontal">   
            <input type="text" id="idi" name="idi" value={{$egre->id}} hidden>  
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <div class="col-md-12">
                <div class="form-group">
                    <p>Anular una VENTA es un proceso irreversible. Si esta seguro de hacerlo describa el motivo a continuación.</p>
                </div>
                <div class="form-group">
                    {!!Form::label('cod', 'Cod. de Venta:', ['class'=>'col-md-2 control-label'])!!}
                    <div class="col-md-10">
                        <input type="text" class="form-control" value={{$egre->venta}} id="cod" name="cod" disabled>
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('motivo', 'Motivo:', ['class'=>'col-md-2 control-label'])!!}
                    <div class="col-md-10">
                        {!!Form::textarea('motivo',null, ['class'=>'form-control', 'rows'=>7])!!}
                    </div>
                </div>
                
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    {!!Form::submit('ANULAR',['class'=>'btn btn-primary'])!!}
                </div>
            </div>
        </form>
    </div>
</div>

@stop
