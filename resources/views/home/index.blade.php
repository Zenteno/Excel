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

</style>
    <div class='row'>
       <div class="col-md-12">
           <div class="box">        
            @include('flash::message')
                <div class="box-header">
                    <h3 class="box-title">Formularios</h3>
                    <span class="btn btn-success fileinput-button pull-right">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Subir Excel</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="file">
                    </span>
                    <a class="btn btn-success" href="/create">
                        <i class="fa fa-plus"></i> Nuevo
                    </a>
                    
                </div>
                            <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Especialidad</th>
                            <th>Médico</th>
                            <th>Hora</th>
                            <th>Fecha</th>
                            <th>Paciente</th>
                            <th>{{ __('Sexo') }}</th>
                            <th>{{ __('RUN') }}</th>
                            <th>{{ __('Ejecutivo') }}</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                            <tbody>
                            @foreach($fichas as $user)
                                <tr>
                                    <td>{{ $user->especialidad }}</td>
                                    <td>{{ $user->medico }}</td>
                                    <td>{{ $user->hora }}</td>
                                    <td>{{ $user->fecha }}</td>
                                    <td>{{ $user->paciente }}</td>
                                    <td>{{ $user->sexo }}</td>
                                    <td>{{ $user->rut }}</td>
                                    <td>{{ $user->ejecutiva }}</td>
                                    <td>
                                        <a href="formularios/{{ $user->id }}" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-search"></span> Detalle
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Médico</th>
                                <th>Hora</th>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>{{ __('Sexo') }}</th>
                                <th>{{ __('RUN') }}</th>
                                <!--<th>{{ __('Intento 1') }}</th>
                                <th>{{ __('Intento 2') }}</th>
                                <th>{{ __('Intento 3') }}</th>-->
                                <th>{{ __('Ejecutivo') }}</th>
                                <th>Actions</th>
                        
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

       </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#example1').DataTable();
            $('#fileupload').fileupload({
                url: '/archivo',
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
    </script>
@endsection