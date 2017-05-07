<?php
    $nomcom = explode(" ", $soluser->nombre);
    if(sizeof($nomcom) >= 4){
        $nom = $nomcom[0].' '.$nomcom[1];
        $pat = $nomcom[2];
        $mat = $nomcom[3];
    }
    if(sizeof($nomcom) == 3){
        $nom = $nomcom[0];
        $pat = $nomcom[1];
        $mat = $nomcom[2];
    }
    if(sizeof($nomcom) == 2){
        $nom = $nomcom[0];
        $pat = $nomcom[1];
        $mat = "";
    }
    if(sizeof($nomcom) == 1){
        $nom = $nomcom[0];
        $pat = '';
        $mat = '';
    }
    $cicom = explode(" ", $soluser->ci);
?>
<div class="form-group">
    {!!Form::label('nombre', 'Nombre(s)', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('nombre',$nom,['class'=>'form-control', 'placeholder'=>'Nombre(s)'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('paterno', 'Ap. Paterno', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        
        {!!Form::text('paterno',$pat,['class'=>'form-control', 'placeholder'=>'Apellido Paterno'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('materno', 'Ap. Materno', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('materno',$mat,['class'=>'form-control', 'placeholder'=>'Apellido Materno'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('ci', 'CI', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::number('ci', $cicom[0],['class'=>'form-control', 'placeholder'=>'Número de Cedulade Identidad'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('exp', 'Expedido en', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::select('exp', ['LP' => 'LA PAZ', 'OR' => 'ORURO', 'CB' => 'COCHABAMBA', 'SC' => 'SANTA CRUZ', 'PO' => 'POTOSI', 'TA' => 'TARIJA', 'CH' => 'CHUQUISACA', 'BE' => 'BENI', 'PA' => 'PANDO'],$cicom[1],['class'=>'form-control'])!!}
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
        {!!Form::select('tipo', ['admin' => 'Administrador', 'almacen' => 'Usuario Almacen', 'solicitud' => 'Usuario Solicitud'],null,['class'=>'form-control'])!!}
    </div>
</div>
	  
	    