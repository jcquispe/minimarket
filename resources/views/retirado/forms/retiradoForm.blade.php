<div class="col-md-6">
    
    <div class="form-group">
        {!!Form::label('codigo', 'Código:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{$retirado}}" readOnly>
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('cinit', 'Producto:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <select name="codigor" id="codigor" autofocus>
			    <option value="">--Código--</option>
			    @foreach($productos as $prod)
			    <option value={{$prod->id}}>{{$prod->codigo}}</option>
			    @endforeach
			</select>
        </div>
    </div>
    
    <div class="form-group" id="desc_prod">
        {!!Form::label('descripcion', 'Descripción:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Descripción del producto" id="descripcionr" readOnly>
        </div>
    </div>
    
    <div class="form-group" id="desc_prod">
        {!!Form::label('cantidad', 'Cantidad:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" value="0" id="cantidad" name="cantidad" required>
        </div>
    </div>
    
</div>
<div class="col-md-6">
     <div class="form-group">
        {!!Form::label('fecha', 'Fecha:', ['class'=>'col-md-3 control-label'])!!}
        <div class="col-md-9">
            <input type="text" class="form-control" value=<?php echo date('Y-m-d')?> id="fecha" name="fecha" disabled>
        </div>
    </div>
    
    <div class="form-group">
        {!!Form::label('motivo', 'Motivo de retiro:', ['class'=>'col-sm-3 control-label'])!!}
        <div class="col-sm-9">
            {!!Form::textarea('motivo',null, ['class'=>'form-control', 'rows'=>4])!!}
        </div>
    </div>
    
</div>
