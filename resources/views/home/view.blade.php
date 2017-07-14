@extends('admin_template')

@section('content')
<div class="row">
<div class="col-md-12">
<div class="x_panel">
<div class="x_title">
	<h2>Detalle #{{ $ficha->id }}</h2>
	<div class="clearfix"></div>
</div>
<div class="x_content">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-body">
				<dl class="dl-horizontal">
					<dt>Especialidad</dt>
					<dd>{{ $ficha->especialidad }}</dd>
					<dt>Médico</dt>
					<dd>{{ $ficha->medico }} </dd>
					<dt>Paciente</dt>
					<dd>{{ $ficha->paciente }}</dd>
					<dt>RUN</dt>
					<dd>{{ $ficha->rut }}</dd>
					<dt>Sexo</dt>
					<dd>{{ $ficha->sexo }} </dd>
					<dt>Observación</dt>
					<dd>{{ $ficha->observacion }} </dd>
				</dl>
			</div>
			<!-- /.box-body -->
		</div>
	<!-- /.box -->
	</div>
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-body">
				<dl class="dl-horizontal">
					<dt>Intento 1</dt>
					<dd>{{ $ficha->intento1 }}</dd>
					<dt>Intento 2</dt>
					<dd>{{ $ficha->intento2 }} </dd>
					<dt>Intento 3</dt>
					<dd>{{ $ficha->intento3 }}</dd>
				</dl>
			</div>
			<!-- /.box-body -->
		</div>
	<!-- /.box -->
	</div>
	<div class="col-md-8">
		<div class="x_panel">
			<div class="x_title">
				<h2>Teléfonos</h2>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="x_content">
			<form class="form-horizontal form-label-left">
				@if ($ficha->fono1 )
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ $ficha->fono1 }}</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control">
							<span class="input-group-btn">
							<button type="button" class="btn btn-primary">¡Enviar!</button>
							</span>
						</div>
					</div>
				</div>
				@endif
				@if ($ficha->fono2 )
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ $ficha->fono2 }}</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control">
							<span class="input-group-btn">
							<button type="button" class="btn btn-primary">¡Enviar!</button>
							</span>
						</div>
					</div>
				</div>
				@endif
				@if ($ficha->fono3 )
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ $ficha->fono3 }}</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control">
							<span class="input-group-btn">
							<button type="button" class="btn btn-primary">¡Enviar!</button>
							</span>
						</div>
					</div>
				</div>
				@endif
			</form>
		</div>
	</div>
</div>
@endsection