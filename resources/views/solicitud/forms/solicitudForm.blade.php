<div class="col-md-6">
    
    <div class="form-group">
        {!!Form::label('codigo', 'Código:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{$venta}}" readOnly>
            <!--input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código de Compra" required-->
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('fecha', 'Fecha:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" value=<?php echo date('Y-m-d')?> id="fecha" name="fecha" disabled>
        </div>
    </div>
    
    <!--div class="form-group">
        {!!Form::label('cinit', 'Cliente:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="NIT o CI" id="cinit" name="cinit">
        </div>
    </div-->
    
    <div class="form-group">
        {!!Form::label('cinit', 'NIT/CI:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="NIT o CI" id="cinit" name="cinit" value="0" required>
        </div>
        <div class="col-md-3">
            <input type="button" class="btn btn-default" value="Verifica" id="verifica">
        </div>
    </div>
    
    <div class="form-group" id="verificadiv">
        {!!Form::label('nombre', 'Nombre:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre" value="S/N" required>
        </div>
    </div>
    
</div>
<div class="col-md-6">
    <div class="form-group">
        {!!Form::label('observacion', 'Observaciones:', ['class'=>'col-sm-3 control-label'])!!}
        <div class="col-sm-9">
            {!!Form::textarea('observacion',null, ['class'=>'form-control', 'rows'=>2])!!}
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('total', 'Importe Total:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" id="total" name="total" value="0" style="font-size:20px; color:#CB355B;" readOnly>
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('pagado', 'Pagado/Cambio:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-5">
            <input type="text" class="form-control" id="pagado" name="pagado" value="0">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="cambio" name="cambio" value="0" style="color:#45A147;" readOnly>
        </div>
    </div>
</div>
