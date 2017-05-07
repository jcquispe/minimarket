@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default cuadro">
		<div class="panel-heading">
		    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> EDITAR USUARIO</h3>
		</div>
		<div class="panel-body">

		    {!!Form::model($user,['route'=>['usuario.update', $user->id], 'method'=>'PUT', 'class'=>'form-horizontal'])!!}
		        @include('usuario.forms.userForm')
		        
		        @if($user->anulado==0)
			        <div class="form-group">
					    {!!Form::label('anulado', 'Anulado:', ['class'=>'col-sm-3 control-label'])!!}
					    <div class="col-sm-9">
					        {!!Form::checkbox('anulado', true, true);!!}
					    </div>
					</div>
					@else
					<div class="form-group">
					    {!!Form::label('anulado', 'Anulado', ['class'=>'col-sm-3 control-label'])!!}
					    <div class="col-sm-9">
					        {!!Form::checkbox('anulado', true, false);!!}
					    </div>
					</div>
				@endif
				
		        <div class="form-group">
			    	<div class="col-sm-offset-3 col-sm-9">
			    		{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary'])!!}
			    	</div>
			    </div>
		    {!!Form::close()!!}
		</div>
	</div>
</div>

@stop