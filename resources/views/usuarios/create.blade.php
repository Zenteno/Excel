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

  <form class="form-horizontal" method="POST" action="{{route('usuarios.store')}}">
      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="name" class="col-md-4 control-label">Nombres</label>

          <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

              @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
          <label for="apellidos" class="col-md-4 control-label">Apellidos</label>

          <div class="col-md-6">
              <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" required autofocus>

              @if ($errors->has('apellidos'))
                  <span class="help-block">
                      <strong>{{ $errors->first('apellidos') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
          <label for="rut" class="col-md-4 control-label">RUT</label>

          <div class="col-md-6">
              <input id="rut" type="text" class="form-control" name="rut" value="{{ old('rut') }}" required autofocus>

              @if ($errors->has('rut'))
                  <span class="help-block">
                      <strong>{{ $errors->first('rut') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
          <label for="telefono" class="col-md-4 control-label">Telefono</label>

          <div class="col-md-6">
              <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required autofocus>

              @if ($errors->has('telefono'))
                  <span class="help-block">
                      <strong>{{ $errors->first('telefono') }}</strong>
                  </span>
              @endif
          </div>
      </div>


      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-Mail</label>

          <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Password Contraseña</label>

          <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group">
          <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

          <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                  Registrar
              </button>
          </div>
      </div>
  </form>
</div>
</div>
</div>

<script type="text/javascript">
  $(function () {
    $('#datepicker').datepicker({
			autoclose: true,
			format: "dd/mm/yyyy",
			language: "es"
		});

    //Datemask dd/mm/yyyy
    //$('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
  //  $('.datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  });
</script>
@endsection
