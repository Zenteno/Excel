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
        <h2>Usuario: {{ $usuarios->name }} {{ $usuarios->apellido }}</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>RUN</dt>
                <dd>{{ $usuarios->rut }}</dd>
                <dt>Fecha de Nacimiento</dt>
                <dd>{{ $usuarios->fecha_nacimiento }}</dd>
                <dt>Correo</dt>
                <dd>{{ $usuarios->email}}</dd>
                <dt>Telefono</dt>
                <dd>{{ $usuarios->telefono }} </dd>
                @foreach($usuarios->roles as $rol)
                <dt>Rol/es</dt>
                <dd>{{ $rol->nombre_rol }} </dd>
                @endforeach
                <dt>Anexo</dt>
                @if ($usuarios->anexo != null)
                <dd>{{ $usuarios->anexo->anexo }}</dd>
                @endif
                @if ($usuarios->anexo == null)
                <dd>no tiene asignado un anexo aún</dd>
                @endif
              </dl>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>


@endsection
