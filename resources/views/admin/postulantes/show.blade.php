@extends('layouts.admin')


@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8 profile-info">
                <h1 class="font-green sbold uppercase">{{ $postulante->nombre_completo }}</h1>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_cargada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Cargada</h3>
                                <p>{{ $postulante->foto_fecha_carga }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_editada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Editada</h3>
                                <p>{{ $postulante->foto_fecha_edicion }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_rechazada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Rechazada</h3>
                                <p>{{ $postulante->foto_fecha_rechazo }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
            </div>
            <!--end col-md-8-->
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet sale-summary">
                            <div class="portlet-title">
                                <div class="caption font-red sbold"> Pagos Realizados </div>
                                <div class="tools">
                                    <a class="reload" href="javascript:;" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <ul class="list-unstyled">
                                    @foreach ($postulante->recaudaciones as $item)
                                        <li>
                                            <span class="sale-info"> {{ $item->fecha.' - '.$item->descripcion }}
                                                <i class="fa fa-img-up"></i>
                                            </span>
                                            <span class="sale-num"> {{ $item->monto }} </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet sale-summary">
                            <div class="portlet-title">
                                <div class="caption font-red sbold"> Verificacion de datos </div>
                                <div class="tools">
                                    <a class="reload" href="javascript:;" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <span class="sale-info"> Lleno datos Personales
                                            <i class="fa fa-img-up"></i>
                                        </span>
                                        <span class="sale-num"> {!! $postulante->procesos->personal !!} </span>
                                    </li>
                                    <li>
                                        <span class="sale-info"> Lleno datos Familiares
                                            <i class="fa fa-img-up"></i>
                                        </span>
                                        <span class="sale-num"> {!! $postulante->procesos->familiar !!} </span>
                                    </li>
                                    <li>
                                        <span class="sale-info"> Lleno datos de Encuesta
                                            <i class="fa fa-img-up"></i>
                                        </span>
                                        <span class="sale-num"> {!! $postulante->procesos->datos_encuesta !!} </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->

            </div>
            <!--end col-md-4-->
            <p><h2><strong>Fecha de Registro :</strong> {{ $postulante->fecha_registro }}</h2></p>
        </div>
        <!--end row-->
        <div class="tabbable-line tabbable-custom-profile">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1" data-toggle="tab" aria-expanded="true"> Datos del Postulante </a>
                </li>
                <li>
                    <a href="#tab_5" data-toggle="tab" aria-expanded="true"> Editar Datos </a>
                </li>
                <li>
                    <a href="#tab_2" data-toggle="tab" aria-expanded="true"> Ficha </a>
                </li>
                <li>
                    <a href="#tab_3" data-toggle="tab" aria-expanded="true"> Usuario </a>
                </li>
                <li>
                    <a href="#tab_4" data-toggle="tab" aria-expanded="true"> Cargar Foto </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-briefcase"></i> Campo </th>
                                    <th class="hidden-xs"><i class="fa fa-edit"></i> Nombre </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Número de Inscripción
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Numero de Identificación
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->identificacion }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Paterno
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->paterno }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Materno
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->materno }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nombres
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombres }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Modalidad
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombre_modalidad }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Especialidad
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombre_especialidad }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 1
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_uno->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 2
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_dos->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 3
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_tres->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->email }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Telefonos
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->telefono_celular.' / '.$postulante->telefono_fijo.' / '.$postulante->telefono_varios }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Institucion Educativa
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->institucion_educativa }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_2">
                <iframe src="{{route('ficha.pdf',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_3">
                    <div class="tab-pane active" id="tab_1_1_1">
                    {!! Form::open(['route'=>'admin.pos.store','method'=>'POST']) !!}
                        <div class="col-md-4">
                        {!!Form::hidden('idpostulante', $postulante->id );!!}
                        {!! Field::text('password',null,['label'=>'Cambiar la contraseña del usuario']) !!}
                        {!!Form::enviar('Actualizar')!!}
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_4">
                    <div class="tab-pane active" id="tab_1_1_1">
                    {!! Form::open(['route'=>'admin.pos.store','method'=>'POST']) !!}
                        <div class="col-md-4">
                        {!!Form::hidden('idpostulante', $postulante->id );!!}

                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_5">
                    {!! Form::model($postulante,['route'=>['admin.pos.update',$postulante],'method'=>'PUT']) !!}
                    @if (str_contains(Auth::user()->codigo_rol,['jefatura','root']))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!!Form::label('lblEdicion', 'Se puede modificar datos',['class'=>'control-label col-md-2']);!!}
                                    <div class="input-group col-md-10">
                                        <div class="icheck-inline">
                                            <label>
                                                {!! Form::radio('datos_ok', 1) !!}
                                                No
                                            </label>
                                            <label>
                                                {!! Form::radio('datos_ok', 0) !!}
                                                Si
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div><!--span-->
                        </div><!--row-->
                    @endif
                    <div class="row">
                        <div class="col-md-2">
                            {!! Field::text('paterno',['label'=>'Apellido Paterno','placeholder'=>'Apellido Paterno']) !!}
                        </div><!--span-->
                        <div class="col-md-2">
                            {!! Field::text('materno',['label'=>'Apellido Materno','placeholder'=>'Apellido Materno']) !!}
                        </div><!--span-->
                        <div class="col-md-2">
                            {!! Field::text('nombres',['label'=>'Nombres','placeholder'=>'Nombres']) !!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-2">
                        {!! Field::text('fecha_nacimiento',['label'=>'Fecha de Nacimiento','placeholder'=>'Fecha de Nacimiento']) !!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('lblDistrito', 'Distrito donde nacio el postulante');!!}
                                {!!Form::select('idubigeonacimiento',UbigeoPersonal($postulante->idubigeonacimiento) ,null , ['class'=>'form-control Ubigeo']);!!}
                            </div>
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('lblDistrito', 'Distrito de residencia del postulante');!!}
                                {!!Form::select('idubigeo',UbigeoPersonal($postulante->idubigeo) ,null , ['class'=>'form-control Ubigeo']);!!}
                            </div>
                        </div><!--span-->
                        <div class="col-md-8">
                            {!! Field::text('direccion',['label'=>'Direccion de postulante','placeholder'=>'Direccion del postulante']) !!}
                        </div><!--span-->
                    </div><!--row-->
                    {!!Form::enviar('Actualizar')!!}
                    {!! Form::close() !!}
                </div>
                <!--tab-pane-->
            </div>
        </div>
    </div>
</div>

@stop
@section('js-scripts')
<script>
$(document).ready(function() {

    $(".Ubigeo").select2({
        width:'auto',
        allowClear: true,
        ajax: {
            url: '{{ url("ubigeo") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    varsearch: params.term // search term
                };
            },
            processResults: function(data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder : 'Seleccione el distrito del participante: ejemplo LIMA',
        minimumInputLength: 3,
        templateResult: format,
        templateSelection: format,
        escapeMarkup: function(markup) {
            return markup;
        } // let our custom formatter work
    });
    function format(res){
        var markup=res.text;
        return markup;

    }

    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal',
        increaseArea: '20%' // optional
    });

});


$(".Fecha").inputmask("y-m-d", {
    "placeholder": "yyyy-mm-dd"
});
</script>
@stop

@section('plugins-styles')
{!! Html::style(asset('assets/pages/css/profile-2.min.css')) !!}
{!! Html::style(asset('assets/global/plugins/icheck/skins/all.css')) !!}
@stop
@section('plugins-js')
{!! Html::script(asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')) !!}
{!! Html::script(asset('assets/global/plugins/icheck/icheck.min.js')) !!}
@stop

@section('menu-user')
@include('menu.profile-admin')
@stop

@section('sidebar')
@include(Auth::user()->menu)
@stop


@section('user-name')
{!!Auth::user()->dni!!}
@stop

@section('breadcrumb')

@stop


@section('page-title')

@stop

@section('page-subtitle')
@stop




