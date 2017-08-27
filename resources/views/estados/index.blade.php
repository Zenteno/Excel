@extends('admin_template')


@section('content')
<style type="text/css">

	table{
		width: 100% !important;
	}
	textarea {
	resize: vertical;
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
							<th class="text-center">#</th>
              <th class="text-center">Estado</th>
							<th class="text-center">Descripción</th>
              <th class="text-center">Acción</th>
            </tr>
          </thead>
					<tbody>
    		@foreach($estados as $estado)
        <tr>
            <td width="55"> {{ $estado -> id }} </td>
						<td width="25%" class="text-center"> {{ $estado -> estado }} </td>
						<td class="text-center">{{$estado -> descripcion}}</td>
						<td width="15%"class="text-right">
 						{!! Form::open(['route' => ['estados.destroy', $estado->id], 'method' => 'DELETE']) !!}
								<button type="submit" class="btn btn-danger btn-xs confirm" data-confirm = '¿Eliminar estado: {{$estado->estado}}?'>
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar
								</button>
								<a class="edit btn btn-info btn-xs" id="{{$estado->id}}">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Editar
								</a>
				    {{Form::close()}}
						</td>
      </tr>
	 			@endforeach
  				</tbody>
          <tfoot>
            <tr>
							<th class="text-center">ID</th>
              <th class="text-center">Estado</th>
							<th class="text-center">Descripción</th>
              <th class="text-center">Acción</th>
            </tr>
          </tfoot>
        </table>
			</div>
    </div>
  </div>
</div>

<!-- Modal crear estado -->
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

<!-- Modal editar descripcion de estado -->
<div id="editmodal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    	<!-- Modal content-->
    	<div class="modal-content">
      	<div class="modal-header">
        <!--	<button type="button" class="close" data-dismiss="modal">&times;</button> -->
        	<h4 class="modal-title" id="titulo"> Editar descripción de estado  </h4>
    		</div>
      	<div class="modal-body">
					<div class="form-group row">
            {{Form::label('Descripcion','Descripción:',['class'=>'col-sm-3 col-form-label'])}}
            <div class="col-sm-12">
               <textarea class="form-control" id="descripcion" rows="2" name="descripcion" required placeholder="Este estado corresponde a los que han sido agendados y confirmados"></textarea>
            </div>
            <input type="hidden" name="id" value="" id="id">
        	</div>
        </div>
      	<div class="modal-footer">
					<button type="button" id="mlsuccess" class= "btn btn-primary pull-right">Guardar cambios</button>
        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
      	</div>
    	</div>
	</div>
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
	$('.confirm').on('click', function (e) {
		return !!confirm($(this).data('confirm'));
	});
	$(document).on('click','.edit',function(e){
		e.preventDefault();
		$("#id").val(e.target.id);
		$("#editmodal").modal()
	});
	$(document).on('click','#mlsuccess',function(e){
		e.preventDefault();
		var status_id = $("#id").val();
		var descp = $('#descripcion').val();
		$.ajax({
			type:'post',
			url: '{!!URL::to('estados/update')!!}',
			data:{'status_id':status_id,
						'descripcion':descp,
						"_token": "{{csrf_token()}}"
						},
			dataType: 'json',
			success:function(data){
				$("#editmodal").modal('hide');
			location.reload();
			},
			error:function(){
			}

		});
	});
});

</script>
@endsection
