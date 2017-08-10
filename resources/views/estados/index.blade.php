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
        <h3 class="box-title">Estados de Fichas</h3>
        <button type="button" class="btn btn-success bootstrap-modal-form-open" data-toggle="modal" data-target="#createmodal">
            <i class="fa fa-plus"></i> Nuevo
        </button>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th WIDTH="55">ID</th>
              <th class="text-center" width="70">Estado</th>
							<th class="text-center">Descripción</th>
              <th width="50" class="text-center">Acción</th>
            </tr>
          </thead>
					<tbody>
    @foreach($estados as $estado)
        <tr>
            <td class="">{{ $estado->id}}</td>
						<td class="text-center">{{ $estado->estado }}</td>
						<td class="text-center">{{$estado->descripcion}}</td>
 					{!! Form::open(['route' => ['estados.destroy', $estado->id], 'method' => 'DELETE']) !!}
							<td class="text-center">
								<button type="submit" class="btn btn-danger btn-xs confirm" data-confirm = '¿Eliminar estado: {{$estado->estado}}?'>
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar
								</button>
            	</td>
							{{Form::close()}}
      </tr>
    				@endforeach

  				</tbody>
          <tfoot>
            <tr>
							<th WIDTH="55">ID</th>
              <th class="text-center" width="70">Estado</th>
							<th class="text-center">Descripción</th>
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
	{!! Form::model($estados, ['method' => 'POST','route' => 'estados.store', 'class'=>'bootstrap-modal-form']) !!}
  <div class="modal-dialog" role="document">

    	<!-- Modal content-->
    	<div class="modal-content">
      	<div class="modal-header">
        <!--	<button type="button" class="close" data-dismiss="modal">&times;</button> -->
        	<h4 class="modal-title">Agregar Nuevo estado</h4>
    		</div>
      	<div class="modal-body">
        	<div class="form-group row">
          	<label for="especialidad" class="col-sm-2 control-label">Nuevo estado:</label>
          	<div class="col-sm-10">
            	<input type="text" class="form-control" name="estado"  required placeholder="Agendado">
          	</div>
      		</div>
					<div class="form-group row">
            {{Form::label('Descripcion','Descripción:',['class'=>'col-sm-3 col-form-label'])}}
            <div class="col-sm-12">
               <textarea class="form-control" rows="2" name="descripcion" required placeholder="Fichas que tienen un horario confirmado"></textarea>
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
