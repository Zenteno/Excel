@extends('admin_template')

@section('content')
<style type="text/css">
	.fileinput-button {
		position: relative;
		overflow: hidden;
		display: inline-block;
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
	table{
		width: 100% !important;
	}
</style>
	<div class='row'>
	   <div class="col-md-12">
		   <div class="box">
			@include('flash::message')
				<div class="box-header">
					<h3 class="box-title">Formularios</h3>
					@if( Auth::user()->hasrole('Administrador'))
					<span class="btn btn-success fileinput-button pull-right">
						<i class="glyphicon glyphicon-plus"></i>
						<span>Subir Excel</span>
						<!-- The file input field used as target for the file upload widget -->
						<input id="fileupload" type="file" name="file">
					</span>
					<a class="btn btn-success" href="/ficha/create">
						<i class="fa fa-plus"></i> Nuevo
					</a>
					@endif
				</div>
							<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Especialidad</th>
								<th>Médico</th>
								<th>Fecha</th>
								<th>Paciente</th>
								<th>RUN</th>
								<th>Estado</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>

	   </div>
	</div>
	<script type="text/javascript">
		$(function(){
			$('#fileupload').fileupload({
				url: '/ficha/archivo',
				dataType: 'json',
				formData: {
					_token : "{{ csrf_token() }}"
				},
				done: function (e, data) {
					 location.reload();
				},
				progressall: function (e, data) {
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
				}
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
				})
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
		$(document).ready(function() {
			var tabla = $('#example1').DataTable( {
				processing: true,
				serverSide: true,
				ajax: '/ficha/listar',
				columns: [
					{ data: "id", name: "formularios.id" },
					{ data: "fespecialidad.especialidad", name: "fespecialidad.especialidad" },
					{ data: "doctor.nombres", name: "doctor.nombres"},
					{ data: "fecha", name: "fecha"},
					{ data: "paciente", name: "paciente"},
					{ data: "rut", name: "rut"},
					{ data: "festado.estado", name: "estado"},
					{ data: 'action', name: 'action', orderable: false, searchable: false}
				],
				language: {
				    "sProcessing":     "Procesando...",
				    "sLengthMenu":     "Mostrar _MENU_ registros",
				    "sZeroRecords":    "No se encontraron resultados",
				    "sEmptyTable":     "Ningún dato disponible en esta tabla",
				    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				    "sInfoPostFix":    "",
				    "sSearch":         "Buscar:",
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
			setInterval( function () {
    		tabla.ajax.reload( null, false ); // paginacion del usuario no cambia
			}, 120000 );
		});
	</script>
@endsection
