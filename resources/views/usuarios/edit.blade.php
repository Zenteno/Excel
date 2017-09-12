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
    @include('flash::message')
      <div class="x_title">
        <h2>Usuario: {{ $usuario->name }}</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Nombre</dt>
                <dd>{{ $usuario->name }}</dd>
                @foreach($usuario->roles as $rol)
                <dt>Rol/les</dt>
                <dd>{{ $rol->nombre_rol }}</dd>
                @endforeach
                <dt>Anexo</dt>
                @if ($usuario->anexo != null)
                <dd>{{ $usuario->anexo->anexo }}</dd>
                @endif
                @if ($usuario->anexo == null)
                <dd>no tiene asignado un anexo aún</dd>
                @endif
                </dl>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="x_title">
        <h2>Actualizar Datos:</h2>
        <div class="clearfix"></div>
      </div>
      {!! Form::model($usuario, ['method' => 'PATCH','route' => ['usuarios.update', $usuario->id]]) !!}
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-body">
            <div class="form-group">
                <label>Especialidades</label>
                <select class="form-control select2" multiple="multiple" data-placeholder="Selecciona una o más especialidades" name="especialidad[]"
                        style="width: 100%;">
                  @foreach ($especialidades as $especialidad)
                  @php($bandera = 0)
                    @foreach($usuario->specialty as $espe)
                      @if($espe->id == $especialidad->id)
                        <option value="{{ $especialidad->id }}" selected>{{ $especialidad->especialidad }}</option>
                        @php($bandera = 1)
                      @endif
                    @endforeach
                    @if($bandera ==0)
                       <option value="{{ $especialidad->id }}">{{ $especialidad->especialidad }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group row col-sm-2">
                  <label>Anexo</label>
                  {!!Form::select('anexo', $anexos->pluck('anexo','id'), $usuario->anexo_id,['class' => 'form-control'])!!}
                </div>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Guardar</button>
          <a href="/usuarios" class="btn btn-default">Cancelar</a>
        </div>

      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </form>
      <script type="text/javascript">
        $('.select2').select2();

      </script>

@endsection
