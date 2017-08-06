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
        <h2>Médico: {{ $medicos->nombres }}</h2>
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


@endsection
