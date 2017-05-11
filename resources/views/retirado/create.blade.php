@extends('layouts.'.Auth::user()->tipo)

@section('contenido')
	    <div class="panel panel-default cuadro">
			  <div class="panel-heading">
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> NUEVO RETIRO</h3>
			  </div>
			  <div class="panel-body">
	    
			    {!!Form::open(['route'=>'retirado.store', 'method'=>'POST', 'class'=>'form-horizontal'])!!}
			        @include('retirado.forms.retiradoForm')

                    
				    <div class="form-group">
				    	<div class="col-sm-offset-3 col-sm-9">
				    		{!!Form::submit('GUARDAR',['class'=>'btn btn-primary'])!!}
				    	</div>
				    </div>
			    {!!Form::close()!!}
			</div>
		</div>
@stop
