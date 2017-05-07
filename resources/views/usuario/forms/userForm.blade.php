<div class="form-group">
    {!!Form::label('nombres', 'Nombre(s)', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('nombres',null,['class'=>'form-control', 'placeholder'=>'Nombre(s)'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('apellidos', 'Apellidos', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('apellidos',null,['class'=>'form-control', 'placeholder'=>'Apellidos'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('us', 'Usuario', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('us',null,['class'=>'form-control', 'placeholder'=>'Nombre de Usuario'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('password', 'Contraseña:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::password('password',['class'=>'form-control', 'placeholder'=>'Contraseña'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('tipo', 'Rol de usuario:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::select('tipo', ['admin' => 'Administrador', 'usuario' => 'Usuario', 'caja' => 'Cajero'],null,['class'=>'form-control'])!!}
    </div>
</div>
	  
	    