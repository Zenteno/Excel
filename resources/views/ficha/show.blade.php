@extends('admin_template')
@section('content')
<style>
	.example-modal .modal {
		position: relative;
		top: auto;
		bottom: auto;
		right: auto;
		left: auto;
		display: block;
		z-index: 1;
	}
	#estados{
	 cursor: pointer;
	}
	.example-modal .modal {
		background: transparent !important;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<a href="/" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-menu-left"></i> volver</a>
			@include('flash::message')
			<div class="x_title">
				<h2>Detalle Ficha #{{$ficha->index_id}}-{{ $ficha->id }}</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<div class="col-sm-4">
					<div class="box box-primary">
		 				<div class="panel-heading">Médico</div>
						<div class="box-body box-profile">
							<h3 class="profile-username text-center">{{ $ficha->doctor->nombres }}</h3>
							<p class="text-muted text-center">{{ $ficha->fespecialidad->especialidad }}</p>
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>RUN</b> <a class="pull-right">{{ $ficha->doctor->run }}</a>
								</li>
							</ul>
							<strong><i class="fa fa-book margin-r-5"></i> Comentarios</strong>
							<p class="text-muted">{{ $ficha->doctor->comentarios }}</p>
						</div>
						<!-- /.box-body -->
		  		</div>

					<div class="box box-primary">
						<div class="panel-heading">Reserva</div>
						<div class="box-body box-profile">
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>Fecha-Hora de Reserva:</b> <a class="pull-right">{{ $ficha->fecha }}</a>
								</li>
							</ul>
						</div>
						<!-- /.box-body -->
					</div>
				</div>


				<div class="col-sm-4">
					<div class="box box-primary">
						<div class="panel-heading">Paciente</div>
						<div class="box-body box-profile">
							<h3 class="profile-username text-center">{{ $ficha->paciente }}</h3>
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>RUN</b> <a class="pull-right">{{ $ficha->rut }}</a>
								</li>
								<li class="list-group-item">
									<b>Sexo</b> <a class="pull-right">{{ $ficha->sexo }}</a>
								</li>
								<li class="list-group-item">
									<b>Edad</b> <a class="pull-right">{{ $ficha->edad }}</a>
								</li>
								<li class="list-group-item">
									<b>Prestacion</b>
									<a class="pull-right">{{ $ficha->prestacion }}</a>
								</li>
							</ul>
							<strong><i class="fa fa-book margin-r-5"></i> Comentarios</strong>
							<p class="text-muted">{{ $ficha->observacion }}</p>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>

				<div class="col-sm-4">
					<div class="box box-primary">
						<div class="panel-heading">Observaciones en Ficha</div>
						<div class="box-body">
							<dl class="dl-horizontal">
								<dt>Registro en ficha 1:</dt>
								<dd>{{ $ficha->intento1 }}</dd>
								<dt>Registro en ficha 2:</dt>
								<dd>{{ $ficha->intento2 }}</dd>
								<dt>Registro en ficha 3:</dt>
								<dd>{{ $ficha->intento3 }}</dd>
							</dl>
						</div>
						<!-- /.box-body -->

					</div>
					<!-- /.box -->
					<div class="box box-primary">

						<div class="box-body">
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>Estado de Ficha</b>
									<a class="pull-right fa fa-edit" id="estados">{{ $ficha->festado->estado }}</a>
								</li>
								<li class="list-group-item form-group">

							          <b>Lugar de Atención:</b>
												<a class="pull-right" id="loc">{{ $ficha->flocation->location_name }}</a>
							          <div class="box-body">
													{!!Form::select('lugar', $lugares->pluck('location_name','id'), null,['placeholder'=>'Cambiar lugar de Atención', 'class' => 'form-control pull-right', 'id'=>'lugarAtencion'])!!}
							          </div>
								</li>
							</ul>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.xcontent -->
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>

<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Teléfonos</h2>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="x_content">
			<div class="col-sm-7">
				<form class="form-horizontal form-label-left">
					<input type="hidden" name="_token" value="{{csrf_token()}}"></input>

					@if ($ficha->fono1 )
					<div class="form-group">
						<input class="col-sm-2" type="text" id="fono1" value="{{ $ficha->fono1 }}">
						<div class="col-sm-2">
							<div class="input-group">
								<span class="input-group-btn">
									<button type="button" class="btn btn-sms btn-primary" id="1">¡Enviar sms!</button>
									<button type="button" class="btn btn-success btn-call" id='1'>¡Llamar!</button>
								</span>
							</div>
						</div>
					</div>
					@endif

					@if ($ficha->fono2 )
					<div class="form-group">
						<input class="col-sm-2" type="text" id="fono2" value="{{ $ficha->fono2 }}">
						<div class="col-sm-2">
							<div class="input-group">
								<span class="input-group-btn">
								<button type="button" class="btn btn-sms btn-primary" id='2' >¡Enviar sms!</button>
								<button type="button" class="btn btn-success btn-call" id='2'>¡Llamar!</button>
								</span>
							</div>
						</div>
					</div>
					@endif

					@if ($ficha->fono3 )
					<div class="form-group">
						<input class="col-sm-2" type="text" id="fono3" value="{{ $ficha->fono3 }}">
						<div class="col-sm-2">
							<div class="input-group">
								<span class="input-group-btn">
								<button type="button" class="btn btn-sms btn-primary" id='3'>¡Enviar sms!</button>
								<button type="button" class="btn btn-success btn-call" id='3'>¡Llamar!</button>
								</span>
							</div>
						</div>
					</div>
					@endif

				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal para actualizar estado de ficha -->
<div id="createmodal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">

    	<!-- Modal content-->
    	<div class="modal-content">
      	<div class="modal-header">
        	<h4 class="modal-title">Actualizar Estado</h4>
    		</div>
      	<div class="modal-body">
        	<div class="form-group row">
          	<label for="estado" class="col-sm-3 control-label">Seleccione estado:</label>
          	<div class="col-sm-9">
							{!!Form::select('estados', $estados->pluck('estado','id'), null,['placeholder'=>'Selecciona un Estado','class' => 'form-control' ,'required', 'id'=>'states'])!!}
          	</div>
      		</div>
        </div>
      	<div class="modal-footer">
      		<button type="button" id="mlsuccess" class= "btn btn-primary pull-right">Aceptar</button>
        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
      	</div>
    	</div>

	</div>
</div>
<!-- End Modal -->

<!-- modal SMS Success -->
	<div class="modal modal-success fade" id="modalsuccess">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Servicio de Mensajeria</h4>
				</div>
				<div class="modal-body">
					<p>¡El sms a sido enviado con exito!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- modal actualizar regstro lamadas -->
		<div class="modal fade" id="actualizareg">
			<div class="modal-dialog">
				<!-- Modal content-->
	    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h4 class="modal-title">Actualizar Registro de LLamada</h4>
	    		</div>
	      	<div class="modal-body">
	        	<div class="form-group row">
	          	<label for="estado" class="col-sm-3 control-label">Seleccione estado de llamada:</label>
	          	<div class="col-sm-9">
								{!!Form::select('callstate', $callstates->pluck('estadollamada','id'), null,['placeholder'=>'Seleccione resultado de la llamada','class' => 'form-control' ,'required', 'id'=>'callreg'])!!}
	          	</div>
							 </div>
							<div class="form-group row">
		          	<label for="estado" class="col-sm-3 control-label">Observación:</label>
		          	<div class="col-sm-9">
									<dd><textarea class="form-control" id="comentario"rows="2" name="comentarios" required placeholder="Paciente no disponible, llamar despues de 16:00hrs."></textarea></dd>
		          	</div>
	      		</div>

	      	<div class="modal-footer">
	      		<button type="button" id="cssucess" class= "btn btn-primary pull-right">Aceptar</button>
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
	      	</div>
	    	</div>
				<!-- /.modal-content -->
			</div>
		</div>
		<!-- /.modal -->


<script>
$('div.alert').not('.alert-important').fadeIn(350).delay(2300).fadeOut(350);
$(document).ready(function(){
	$(document).on('click','.btn-sms',function(e){
			e.preventDefault();
			console.log(this);
			var telefono=$('#fono'+this.id).val();
			console.log(telefono);
			var ficha_id ={{ $ficha->id }};
			console.log(telefono);
			$.ajax({
				type:'post',
				url: '{!!URL::to('ficha/mensajeria')!!}',
				data:{'ficha':ficha_id,
							'telefono':telefono,
							"_token": "{{csrf_token()}}"
							},
				dataType: 'json',
				error:function(){
				}
			});
			$('#modalsuccess').modal();
		});

		$(".btn-call").click(function(e){
			var telefono = $('#fono'+this.id).val();
			$.post("llamada",{
				telefono : telefono,
				anexo : 4000,
				"_token": "{{csrf_token()}}"
			},
			function( data ) {
				console.log(data);
				$("#actualizareg").modal();
				$('#cssucess').click(function(e){
					var obj = JSON.parse(data);
					var estado = $('#callreg').val();
					var comentario = $('#comentario').val();
					var ficha_id = {{$ficha->id}};
					$.post("callstatereg",{
						ficha_id	: ficha_id,
						telefono	: telefono,
						estado		: estado,
						comentario: comentario,
						respuesta	: obj.respuestaOK,
						mensaje		: obj.mensaje,
						uniqueId	: obj.uniqueId,
						"_token": "{{csrf_token()}}",
					},function(data){
						console.log(data);
						$("#actualizareg").modal('hide');
						location.reload();
					});
				});


		});
	});




		$(document).on('click','#estados',function(e){
			e.preventDefault();
			$("#createmodal").modal();
		});


		$(document).on('click','#mlsuccess',function(e){
			e.preventDefault();
			var status_id = $('#states').val();
			var ficha_id ={{ $ficha->id }};
			var estado
			$.ajax({
				type:'post',
				url: '{!!URL::to('ficha/changestatus')!!}',
				data:{'ficha':ficha_id,
							'status_id':status_id,
							"_token": "{{csrf_token()}}"
							},
				dataType: 'json',
				success:function(data){
					console.log(data);
					$("#createmodal").modal('hide');
					location.reload();
				},
				error:function(){
				}

			});
		});

		$(document).on('change','#lugarAtencion', function(){
			var lugaten_id=$(this).val();
			var ficha_id ={{ $ficha->id }};
			console.log(lugaten_id);
			$.ajax({
				type:'post',
				url: '{!!URL::to('ficha/changelugar')!!}',
				data:{'lug_id':lugaten_id,
							'fichaid': ficha_id,
							"_token": "{{csrf_token()}}"
						},
				dataType: 'json',
				success:function(data){
							console.log('success');
							console.log(data);
							location.reload();
				},
				error:function(){
				}
			});
		});
});
</script>
@endsection
