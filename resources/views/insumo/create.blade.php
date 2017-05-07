@extends('layouts.'.Auth::user()->tipo)

@section('contenido')
	    <div class="panel panel-default cuadro">
			  <div class="panel-heading">
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> PRODUCTO NUEVO</h3>
			  </div>
			  <div class="panel-body">
	    
			    {!!Form::open(['route'=>'insumo.store', 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true])!!}
			        @include('insumo.forms.insumoForm')

                    
				    <div class="form-group">
				    	<div class="col-sm-offset-3 col-sm-9">
				    		{!!Form::submit('GUARDAR',['class'=>'btn btn-primary'])!!}
				    	</div>
				    </div>
			    {!!Form::close()!!}
			</div>
		</div>
@stop
