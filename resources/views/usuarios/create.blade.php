@extends('admin_template')
@section('content')
<style type="text/css">
  .select2-selection__choice{
    background-color: #3c8dbc !important;
    border: 1px solid #3c8dbc !important;
  }
  .select2-selection__choice__remove{
    color:white !important;
  }

  textarea {
  resize: vertical;
}
</style>

<div class="row">
  <div class="col-md-12">
<!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Registrar nuevo Usuario</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
     {!! Form::open(['method' => 'POST','route' => 'usuarios.store']) !!}
      <div class="box-body">

        <div class="form-group row">
            <label for="name" class="col-md-2 control-label">Nombre Usuario</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>


                    <span class="help-block">
                        <strong></strong>
                    </span>

            </div>
        </div>


        <div class="form-group row">
            <label for="email" class="col-md-2 control-label">Correo</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>


                    <span class="help-block">
                        <strong></strong>
                    </span>

            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-2 control-label">Contraseña</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>


                    <span class="help-block">
                        <strong></strong>
                    </span>

            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-2 control-label">Confirmar contraseña</label>
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

      <!-- /.box-body -->
      <div class="box-footer">
        {!! Form::submit('Guardar', ["class" => "btn btn-primary pull-right"]) !!}
        <a href="/usuarios" class="btn btn-default">Cancelar</a>
      </div>
      <!-- /.box-footer -->
  </div>
  {!! Form::close() !!}
</div>
</div>
</div>
@endsection
