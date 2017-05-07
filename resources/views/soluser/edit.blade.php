@extends('layouts.'.Auth::user()->tipo)

@section('contenido')

	    <div class="panel panel-default cuadro">
			  <div class="panel-heading">
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span>PROCESANDO USUARIO NUEVO</h3>
			  </div>
			  <div class="panel-body">
	    
			    {!!Form::open(['route'=>'usuario.store', 'method'=>'POST', 'class'=>'form-horizontal'])!!}
			        @include('soluser.forms.soluserForm')

					<div class="form-group">
			        	{!!Form::label('unidad_id', 'Dependencia:', ['class'=>'col-sm-3 control-label'])!!}
				        <div class="col-sm-9">
				            <select id="unidad_id" name="unidad_id" class="form-control">
				            @foreach($unidads as $uni)
				            	<option value={{$uni['id']}}>{{$uni['denominacion']}}</option>
				            @endforeach	
				        	</select>
				        </div>
			        </div>
			        
			        <div class="form-group">
				    	<div class="col-sm-offset-3 col-sm-9">
				    		{!!Form::submit('GUARDAR',['class'=>'btn btn-primary'])!!}
				    	</div>
				    </div>
			    {!!Form::close()!!}
			</div>
		</div>

@stop