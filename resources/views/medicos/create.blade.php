@extends('admin_template')

@section('content')

<style type="text/css">
textarea {
resize: vertical;
}
</style>

<div class="row">
  <div class="col-md-12">
    @include('flash::message')
<!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Registrar nuevo Médico</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
     {!! Form::model($medicos, ['method' => 'POST','route' => 'medicos.store']) !!}
  <!--<form class="form-horizontal" action="medicos/create" method="POST">-->
      <div class="box-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 control-label">RUN</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="run" required placeholder="12345678-1">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombres</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nombres" required placeholder="Nombre">
          </div>
        </div>
        <div class="form-group row">

        </div>
        <div class="form-group row">
          {{Form::label('especialidad','Especialidad:',['class'=>'col-sm-2 col-form-label'])}}
          <div class="col-sm-4">
            {!!Form::select('especialidad_id', $especialidades->pluck('especialidad','id'), null,['placeholder'=>'Selecciona una Especialidad','class' => 'form-control' ,'required'])!!}
          </div>
        </div>
        <div class="form-group row">
            {{Form::label('Comentarios','Comentarios:',['class'=>'col-sm-3 col-form-label'])}}
            <div class="col-sm-12">
               <textarea class="form-control" rows="3" name="comentarios" required placeholder="Este especialista atendera solo los dias lunes de 14:00 - 16:00 Hrs."></textarea>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <!-- /.box-body -->
      <div class="box-footer">
        {!! Form::submit('Guardar', ["class" => "btn btn-primary pull-right"]) !!}
        <a href="/medicos" class="btn btn-default">Cancelar</a>
      </div>
      <!-- /.box-footer -->
      {!! Form::close() !!}


  </div>
</div>

@endsection
