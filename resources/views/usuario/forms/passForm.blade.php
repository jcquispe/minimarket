<div class="form-group">
    {!!Form::label('actual', 'Contraseña actual:', ['class'=>'col-md-4 control-label'])!!}
    <div class="col-md-8">
        {!!Form::password('actual',['class'=>'form-control', 'value'=>'', 'required'=>true])!!}
    </div>
</div>
<div class="form-group">
    {!!Form::label('nueva', 'Contraseña nueva:', ['class'=>'col-md-4 control-label'])!!}
    <div class="col-md-8">
        {!!Form::password('nueva',['class'=>'form-control', 'value'=>'', 'required'=>true])!!}
    </div>
</div>
<div class="form-group">
    {!!Form::label('validar', 'Repetir contraseña:', ['class'=>'col-md-4 control-label'])!!}
    <div class="col-md-8">
        {!!Form::password('validar',['class'=>'form-control', 'value'=>'', 'required'=>true])!!}
    </div>
</div>
<input type="text" id="use" name="use" value={{Auth::user()->id}} hidden>
<div class="form-group">
    <code id="msgcode" hidden>Las contraseñas no coinciden</code>
</div>
