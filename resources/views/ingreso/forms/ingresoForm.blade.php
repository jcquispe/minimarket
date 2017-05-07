<div class="col-md-6">
    
    <div class="form-group">
        {!!Form::label('codigo', 'Código:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{$compra}}" readOnly>
            <!--input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código de Compra" required-->
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('fecha', 'Fecha:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <!--input type="text" class="form-control" id="fecha" name="fecha"  disabled-->
            <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d');?>" placeholder="Fecha de ingreso" required>
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('proveedor', 'Proveedor:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            {!!Form::text('proveedor', null,['class'=>'form-control', 'placeholder'=>'Proveedor'])!!}
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('factura', 'Factura:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            {!!Form::text('factura', null,['class'=>'form-control', 'placeholder'=>'Número de Factura'])!!}
        </div>
    </div>
</div>
<div class="col-md-6">
    
    <div class="form-group">
        {!!Form::label('observacion', 'Observaciones:', ['class'=>'col-sm-3 control-label'])!!}
        <div class="col-sm-9">
            {!!Form::textarea('observacion',null, ['class'=>'form-control', 'rows'=>5])!!}
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('total', 'Total:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" id="total" name="total" value="0" readOnly>
        </div>
    </div>
</div>
