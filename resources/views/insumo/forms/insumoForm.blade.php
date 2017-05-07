<div class="form-group">
    {!!Form::label('codigo', 'Código:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('codigo',null,['class'=>'form-control', 'placeholder'=>'Código del Producto'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('codigo2', 'Código 2:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('codigo2',null,['class'=>'form-control', 'placeholder'=>'Código del Producto'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('codigo3', 'Código 3:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('codigo3',null,['class'=>'form-control', 'placeholder'=>'Código del Producto'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('descripcion', 'Descripción:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('descripcion',null,['class'=>'form-control', 'placeholder'=>'Nombre del Producto'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('imagen', 'Imagen del producto:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::file('imagen',null,['class'=>'form-control', null])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('unidad', 'Unidad de medida:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::select('unidad', ['UNIDAD' => 'Unidad', 'PAQUETE' => 'Paquete', 'BOLSA' => 'Bolsa', 'CAJA' => 'Caja', 'LITRO' => 'Litro', 'KILO' => 'Kilogramo'],null,['class'=>'form-control'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('precio_compra', 'Precio de Compra:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('precio_compra',null,['class'=>'form-control', 'placeholder'=>'Precio de Adquisición'])!!}
    </div>
</div>

<div class="form-group">
    {!!Form::label('precio_venta', 'Precio de Venta:', ['class'=>'col-sm-3 control-label'])!!}
    <div class="col-sm-9">
        {!!Form::text('precio_venta',null,['class'=>'form-control', 'placeholder'=>'Precio de Comercialización'])!!}
    </div>
</div>
	  