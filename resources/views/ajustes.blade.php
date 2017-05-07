@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

@include('alerts.success')
@include('alerts.error')

    <div class="cuadro panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> AJUSTES DE USUARIO</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-4">
                <a href="#" id="camimg"><img src="/img/logo.png" id="foto"></a>
            </div>
            <div class="col-sm-8">
                <div class="form-horizontal">
                    <div class="form-group">
                        {!!Form::label('nombre', 'Nombre(s):', ['class'=>'col-sm-3 control-label'])!!}
                        <div class="col-sm-9">
                            <h4><strong>{{ Auth::user()->nombres }}</strong></h4>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!!Form::label('paterno', 'Apellidos:', ['class'=>'col-sm-3 control-label'])!!}
                        <div class="col-sm-9">
                            <h4><strong>{{ Auth::user()->apellidos }}</strong></h4>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!!Form::label('us', 'Nombre de Usuario:', ['class'=>'col-sm-3 control-label'])!!}
                        <div class="col-sm-9">
                            <h4><strong>{{ Auth::user()->us }}</strong></h4>
                        </div>
                    </div>
                    
                    <div class="form-group" id="botcampass">
                        {!!Form::label('password', 'Contraseña:', ['class'=>'col-sm-3 control-label'])!!}
                        <div class="col-sm-9">
                            <!--button id="showModal" class="btn btn-danger"  data-toggle="modal" data-target="#myModal">Cambiar Contraseña</button-->
                            <button id="campass" class="btn btn-danger" >Cambiar Contraseña</button>
                        </div>
                    </div>
                    
                    <div id="formcampass" hidden>
                        <form action="/usuario/campass" method="post" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <div class="form-group" >
                                {!!Form::label('actualp', 'Contraseña actual:', ['class'=>'col-sm-3 control-label'])!!}
                                <div class="col-sm-9">
                                    {!!Form::password('actualp',['class'=>'form-control', 'value'=>'', 'required'=>true])!!}
                                </div>
                            </div>

                            <div class="form-group" >
                                {!!Form::label('nuevap', 'Nueva contraseña:', ['class'=>'col-sm-3 control-label'])!!}
                                <div class="col-sm-9">
                                    {!!Form::password('nuevap',['class'=>'form-control', 'value'=>'', 'required'=>true])!!}
                                </div>
                            </div>

                            <div class="form-group" >
                                {!!Form::label('validarp', 'Confirmar contraseña:', ['class'=>'col-sm-3 control-label'])!!}
                                <div class="col-sm-9">
                                    {!!Form::password('validarp',['class'=>'form-control', 'value'=>'', 'required'=>true])!!}
                                </div>
                            </div>

                            <input type="text" id="use" name="use" value={{Auth::user()->id}} hidden>
                            <div class="form-group">
                                <code id="msgcodep" hidden>Las contraseñas no coinciden</code>
                            </div>
            
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-danger" >Cambiar</button>
                                    <button type="button" class="btn btn-default" id="cancelacampass">Cancelar</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

@stop

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">CAMBIAR CONTRASEÑA</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	    @include('usuario.forms.passForm')
	    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="cambiar" class="btn btn-primary" disabled>Cambiar</button>
      </div>
       
    </div>
  </div>
</div>