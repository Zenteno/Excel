@extends('admin_template')


@section('content')
<style type="text/css">

	table{
		width: 100% !important;
	}
	.fileinput-button input {
		position: absolute;
		top: 0;
		right: 0;
		margin: 0;
		opacity: 0;
		-ms-filter: 'alpha(opacity=0)';
		font-size: 200px !important;
		direction: ltr;
		cursor: pointer;
	}
</style>
<div class='row'>
  <div class="col-md-12">
    <div class="box">
      @include('flash::message')
      <div class="box-header">
        <h3 class="box-title">Registro de llamadas</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Ficha #</th>
              <th>Telefono de Destino</th>
              <th>Estado de llamada</th>
              <th>Comentario</th>
              <th>Fecha</th>
              <th>Acción</th>
            </tr>
          </thead>
					<tbody>
            @foreach($registro as $esllam)
                <tr>
                    <td class="">{{$esllam->cficha->id}}-{{ $esllam->ficha_id}}</td>
                    <td class="">{{ $esllam->telefono}}</td>
        						<td class="">{{ $esllam->ccallstate->estadollamada}}</td>
                    <td class="">{{ $esllam->comment }}</td>
                    <td class="">{{  $esllam->created_at }}</td>
                    {!! Form::open(['route' => ['regllamadas.destroy', $esllam->id], 'method' => 'DELETE']) !!}
                      	<td class="text-center">
          								<button type="submit" class="btn btn-danger btn-xs confirm" data-confirm = '¿Eliminar Registro: {{ $esllam->cficha->id}}-{{$esllam->id }}?'>
                              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          								</button>
                          <a href="{{ route('regllamadas.show', $esllam->id) }}" class="btn btn-primary btn-xs">detalles
                              <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                          </a>
                      	</td>
                    {{Form::close()}}
              </tr>
            				@endforeach
  				</tbody>
        </table>

				</div>
      </div>
    </div>
  </div>
</div>

<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
$(document).ready(function(){
$('#example1').dataTable({

	language:{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar  _MENU_  registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0. De un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:	 ",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
	}

});

});
$('.confirm').on('click', function (e) {
	return !!confirm($(this).data('confirm'));
});


</script>
@endsection
