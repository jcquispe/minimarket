
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <title>SWAM - Login</title>
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/style.css') !!}
  </head>

  <body>
    <div class="container">
      @include('alerts.error')
      <div class="info">
        <h1>SWAM</h1><span><a href="#">Sistema Web de Administración de Minimarket</a></span>
      </div>
    </div>
    <div class="form">
      <div class="thumbnail"><img src="img/logo.png"/></div>
      {!!Form::open(['route'=>'log.store', 'method'=>'POST', 'class'=>'ingreso-form'])!!}
        {!!Form::text('usuario',null,['placeholder'=>'Usuario'])!!}
        {!!Form::password('pass',['placeholder'=>'Contraseña'])!!}
        {!!Form::submit('Entrar',['class'=>'btn btn-success'])!!}
      {!!Form::close()!!}
    </div>
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/index.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
  </body>
</html>
