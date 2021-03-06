@extends('admin_template')

@section('content')
	<style type="text/css">
		.infecha{
			width: 82%;
			padding-left: 15px !important;
		}

	</style>

	<div class="row">
		<div class="col-md-12">
	<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Nueva Reserva</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<form class="form-horizontal" action="/ficha" method="POST">
				<div class="box-body">
					<div class="form-group row">
			          {{Form::label('medico','Médico',['class'=>'col-sm-2 control-label'])}}
			          <div class="col-sm-10">
									{!!Form::select('medico', $medicos->pluck('nombres','id'), null,['placeholder'=>'Selecciona un Médico','class' => 'form-control' ,'required', 'id'=>'medico'])!!}
			          </div>
			    </div>
					<div class="bootstrap-timepicker">
						<div class="form-group">
							<label class="col-sm-2 control-label">Hora</label>
							<div class="input-group infecha">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
								<input type="text" class="form-control timepicker" name="hora">
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 control-label">Fecha</label>
						<div class="input-group date col-sm-4 infecha">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right datepicker" id="datepicker" required name="fecha">
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 control-label">Paciente</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="paciente"  required placeholder="Humberto Santana">
						</div>
						<label for="inputEmail3" class="col-sm-1 control-label">Edad</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="edad" required placeholder="18">
						</div>
						<label for="inputEmail3" class="col-sm-1 control-label">Sexo</label>
						<div class="col-sm-2">
							<select class="form-control" name="sexo">
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 control-label">RUN</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" required name="rut" placeholder="11111111-1">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 control-label">Prestación</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" required name="prestacion" placeholder="Interconsulta">
						</div>
						<label for="inputEmail3" class="col-sm-2 control-label">Estado</label>
						<div class="col-sm-4">
							 {!!Form::select('estado', $estados->pluck('estado','id'), null,['selected'=>'Pendiente','class' => 'form-control' ,'required'])!!}
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 control-label">Ejecutivo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ejecutiva" placeholder="María Arredondo">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Teléfonos</label>
						<div class="col-sm-10">
							<div class="col-xs-4">
								<input type="text" class="form-control" placeholder="Teféfono 1" name="fono1">
							</div>
							<div class="col-xs-4">
								<input type="text" class="form-control" placeholder="Teléfono 2" name="fono2">
							</div>
							<div class="col-xs-4">
								<input type="text" class="form-control" placeholder="Teléfono 3" name="fono3">
							</div>
						</div>
					</div>
			<!-- Elimina Ingreso de intentos al crear ficha.
						<div class="form-group">
						<label class="col-sm-2 control-label">Intentos</label>
						<div class="col-sm-10">
							<div class="col-xs-4">
								<input type="text" class="form-control" placeholder="Intento 1" name="intento1">
							</div>
							<div class="col-xs-4">
								<input type="text" class="form-control" placeholder="Intento 2" name="intento2">
							</div>
							<div class="col-xs-4">
								<input type="text" class="form-control" placeholder="Intento 3" name="intento3">
							</div>
						</div>
					</div>
				</div>

			-->
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<!-- /.box-body -->
				<div class="box-footer">
					<a href="/" class="btn btn-default">Cancelar</a>
					<button type="submit" class="btn btn-primary pull-right">Guardar</button>
				</div>
				<!-- /.box-footer -->
			</form>


		</div>
		</div>
	</div>
	<script type="text/javascript">
		$('#datepicker').datepicker({
			autoclose: true,
			format: "yyyy/mm/dd",
			language: "es"
		});
		$('.timepicker').timepicker({
			showInputs: false,
			showMeridian: false
		});

	</script>
@endsection
