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
	<div class="col-md-9 col-sm-9 col-xs-12" style="width: 100%;">
		<ul class="stats-overview">
			<li>
				<span class="name"> Especialiad </span>
				<span class="value text-success"> {{ $ficha->especialidad }} </span>
			</li>
			<li>
				<span class="name"> Médico </span>
				<span class="value text-success"> {{ $ficha->medico }} </span>
			</li>
			<li>
				<span class="name"> Paciente </span>
				<span class="value text-success"> {{ $ficha->paciente }} </span>
			</li>
		</ul>
		<br />
	</div>
	<div class="col-md-9 col-sm-9 col-xs-12" style="width: 100%;">
		<ul class="stats-overview">
			<li>
				<span class="name"> RUT </span>
				<span class="value text-success"> {{ $ficha->rut }} </span>
			</li>
			<li>
				<span class="name"> Sexo </span>
				<span class="value text-success"> {{ $ficha->sexo }} </span>
			</li>
			<li>
				<span class="name"> Obs </span>
				<span class="value text-success"> {{ $ficha->observacion }} </span>
			</li>
		</ul>
		<br />
	</div>
	<div class="col-md-9 col-sm-9 col-xs-12" style="width: 100%;">
		<ul class="stats-overview">
			<li>
				<span class="name"> 1 Intento </span>
				<span class="value text-success"> {{ $ficha->intento1 }} </span>
			</li>
			<li>
				<span class="name"> 2 Intento </span>
				<span class="value text-success"> {{ $ficha->intento2 }} </span>
			</li>
			<li>
				<span class="name"> 3 Intento </span>
				<span class="value text-success"> {{ $ficha->intento3 }} </span>
			</li>
		</ul>
		<br />
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
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