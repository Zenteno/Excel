<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="/bower_components/AdminLTE/dist/img/avatar.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{Auth::user()->name}}</p>
				<!-- Status -->
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form (Optional) -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
				</button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">Menú</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="active"><a href="/"><i class="fa fa-link"></i> <span>Fichas Confirmación</span></a></li>
			@if( Auth::user()->hasrole('Administrador') )
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Administración</span>
				<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
				</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="/medicos">Médicos</a></li>
					<li><a href="/especialidades">Especialidades</a></li>
					<li><a href="/regllamadas">Registro de llamadas</a></li>
					<li><a href="/estados">Estados Fichas</a></li>
					<li><a href="/usuarios">Usuarios</a></li>
				</ul>
			</li>
			@endif
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>
