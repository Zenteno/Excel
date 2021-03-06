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
        <h3 class="box-title">Usuarios</h3>
          <a class="btn btn-success fileinput-button" href="usuarios/create">
            <i class="fa fa-plus"></i> Nuevo
          </a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Observaciones</th>
              <th>Acción</th>
            </tr>
          </thead>
					<tbody>
    @foreach($usuarios as $usuario)
        <tr>
            <td class="">{{ $usuario->name  }}</td>
						<td class="">{{ $usuario->email }}</td>
            <td class="">{{ $usuario->email }}</td>

 					{!! Form::open(['route' => ['usuarios.destroy', $usuario->id], 'method' => 'DELETE']) !!}
            	<td class="text-center">
								<button type="submit" class="btn btn-danger btn-xs confirm" data-confirm = '¿Eliminar Usuario: {{ $usuario->name }}?'>
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</button>
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-info btn-xs">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                </a>
            	</td>
							{{Form::close()}}
      </tr>
    				@endforeach

  				</tbody>
          <tfoot>
            <tr>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Observaciones</th>
              <th>Acción</th>
            </tr>
          </tfoot>
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
