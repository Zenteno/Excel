@extends('admin_template')


@section('content')
<style type="text/css">

	table{
		width: 100% !important;
	}
</style>


<div class='row'>
  <div class="col-md-12">
    <div class="box box-info">
			@include('flash::message')
      <div class="box-header">
        <h3 class="box-title">Especialidades Medicas</h3>
        <button type="button" class="btn btn-success bootstrap-modal-form-open" data-toggle="modal" data-target="#createmodal">
            <i class="fa fa-plus"></i> Nueva
        </button>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th WIDTH="60">Cod. Especialidad</th>
              <th class="text-center">Especialidad</th>
              <th width="50" class="text-center">Acción</th>
            </tr>
          </thead>
					<tbody>
    @foreach($especialidades as $especialidad)
        <tr>
            <td class="">{{ $especialidad->id}}</td>
						<td class="text-center">{{ $especialidad->especialidad }}</td>
 					{!! Form::open(['route' => ['especialidades.destroy', $especialidad->id], 'method' => 'DELETE']) !!}
            	<td class="text-center">
								<button type="submit" class="btn btn-danger btn-xs confirm" data-confirm = '¿Eliminar Especialidad: {{$especialidad->especialidad}}?'>
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar
								</button>
            	</td>
							{{Form::close()}}
      </tr>
    				@endforeach

  				</tbody>
          <tfoot>
            <tr>
              <th WIDTH="60">Cod. Especialidad</th>
              <th class="text-center">Especialidad</th>
              <th width="50" class="text-center">Acción</th>
            </tr>
          </tfoot>
        </table>

				</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="createmodal" class="modal fade" role="dialog">
	{!! Form::model($especialidades, ['method' => 'POST','route' => 'especialidades.store', 'class'=>'bootstrap-modal-form']) !!}
  <div class="modal-dialog" role="document">

    	<!-- Modal content-->
    	<div class="modal-content">
      	<div class="modal-header">
        <!--	<button type="button" class="close" data-dismiss="modal">&times;</button> -->
        	<h4 class="modal-title">Agregar Nueva Especialidad Médica</h4>
    		</div>
      	<div class="modal-body">
        	<div class="form-group row">
          	<label for="especialidad" class="col-sm-2 control-label">Especialidad:</label>
          	<div class="col-sm-10">
            	<input type="text" class="form-control" name="especialidad" placeholder="Medicina Interna">
          	</div>
        	</div>
      	</div>
      	<div class="modal-footer">
        	{!! Form::submit('Guardar', ["class" => "btn btn-primary pull-right"]) !!}
        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
      	</div>
    	</div>
  
	</div>
  {{Form::close()}}
</div>
<!-- End Modal -->

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
