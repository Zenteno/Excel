@extends('admin_template')

@section('content')

<style type="text/css">
  .infecha{
    width: 82%;
    padding-left: 15px !important;
  }

  textarea {
resize: vertical;
}

</style>
<div class="row">
  <div class="col-md-12">
    @include('flash::message')
      <div class="x_title">
        <h2>Médico: {{ $medicos->paterno }} {{ $medicos->materno }}, {{ $medicos->nombres }}</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>RUN</dt>
                <dd>{{ $medicos->run }}</dd>
                <dt>Especialidad</dt>
                <dd>{{ $medicos->specialty->especialidad }}</dd>
                <dt>Observaciones</dt>
                <dd>{{ $medicos->comentarios }} </dd>
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
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-body">
            {!! Form::model($medicos, ['method' => 'PATCH','route' => ['medicos.update', $medicos->id]]) !!}
            <dl class="dl-horizontal form-group">
              <dt>Especialidad</dt>
              <dd>{!!Form::select('especialidad_id', $especialidades->pluck('especialidad','id'), null,['placeholder'=>'Selecciona una Especialidad','class' => 'form-control'])!!}</dd>
              <dt>Observaciones</dt>
              <dd><textarea class="form-control" rows="3" name="comentarios" required placeholder="{{ $medicos->comentarios }}"></textarea></dd>
            </dl>
          </div>
        </div>
        <div class="box-footer">
          {!! Form::submit('Guardar cambios', ["class" => "btn btn-primary pull-right"]) !!}
          <a href="/medicos" class="btn btn-default">Cancelar</a>
        </div>
        <!-- /.box-footer -->
        {{Form::close()}}
      </div>

@endsection
