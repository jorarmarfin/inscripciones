@extends('layouts.base')

@section('content')
@include('alerts.errors')
{!! Form::model($postulante,['route'=>['datos.postulante.update',$postulante],'method'=>'PUT','files'=>true]) !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">DATOS PERSONALES DEL postulante (NO DEL APODERADO)</span>
            </div>
            <div class="actions">
                {!!Form::back(route('datos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <dl>
                <dt>Observación</dt>
                <dd>Los nombres y apellidos deben coincidir con el DNI del postulante, los campos con asterisco son obligatorios.</dd>
            </dl>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Form::hidden('idtipoidentificacion', IdTCCodigo('IDENTIFICACION','DNI') );!!}
                        {!!Form::hidden('numero_identificacion', Auth::user()->dni );!!}
                        {!!Field::text('paterno', null , ['label'=>'Apellido Paterno del postulante (*)','placeholder'=>'Apellido Paterno del postulante']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Field::text('materno', null , ['label'=>'Apellido Materno del postulante (*)','placeholder'=>'Apellido Materno del postulante']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Field::text('nombres', null , ['label'=>'Nombres del postulante (*)','placeholder'=>'Nombre el postulante']);!!}
                    </div>
                </div><!--span-->
            </div><!--row-->
            <h3>Modalidad de Postulación según el reglamento</h3>
                <div class="row">
                    <div class="col-md-6">
                    @if ($postulante->idmodalidad==16)
                        {!!Field::select('idmodalidad',$modalidad2,['label'=>'Escoger Modalidad (*)','empty'=>'Escoger modalidad de postulacion']);!!}
                    @else
                        {!!Field::select('idmodalidad',$modalidad,['label'=>'Escoger Modalidad (*)','empty'=>'Escoger modalidad de postulacion']);!!}
                    @endif
                    </div><!--span-->
                    <div class="col-md-6">
                        {!!Field::select('idespecialidad',$especialidad,['label'=>'Escoger Especialidad (*)','empty'=>'Escoger especialidad de postulacion']);!!}
                    </div><!--span-->
                </div><!--row-->
                <div class="widget-thumb bordered bg-green cepreuni">
                    <div class="row">
                        <div class="col-md-6 ">
                            {!!Field::text('codigo_verificacion',null,['label'=>'Ingresar codigo de CEPRE-UNI','placeholder'=>'Ingresar codigo de CEPRE-UNI']);!!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            {!!Field::select('idmodalidad2',$segunda_modalidad_cepre,['label'=>'Escoger segunda Modalidad (Solo para alumnos de CEPRE-UNI)','empty'=>'Escoger segunda modalidad de postulacion (Solo para alumnos de CEPRE-UNI)']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::select('idespecialidad2',$especialidad,['label'=>'Escoger segunda Especialidad (Solo para alumnos de CEPRE-UNI)','empty'=>'Escoger segunda especialidad de postulacion (Solo para alumnos de CEPRE-UNI)']);!!}
                        </div><!--span-->
                    </div><!--row-->
                </div>
            <h3>Institución Educativa del postulante</h3>
                <dl>
                    <dt>Observación</dt>
                    <dd>Queda bajo responsabilidad del postulante seleccionar la Institución Educativa de donde procede, <strong>todo cambio de colegio incurrirá en un nuevo pago sin lugar a reembolso Art. 13 Reglamento de Admisión.</strong></dd>
                </dl>
                <div class="row">
                    <div class="col-md-6 Colegio">
                            {!!Field::select('idcolegio',ColegioPersonal($postulante->idcolegio),['label'=>'Escoger Colegio']);!!}
                    </div><!--span-->
                    <div class="col-md-6 Universidad">
                        {!!Field::select('iduniversidad',UniversidadPersonal($postulante->idcolegio),['label'=>'Escoger Universidad']);!!}
                    </div><!--span-->
                </div><!--row-->
            {!!Form::enviar('Guardar')!!}
        </div>
    </div>
    <!-- END PORTLET-->
</div>
{!! Form::close() !!}
@stop

@section('js-scripts')
<script>
$(function() {
$(".Colegio").hide();
$(".Universidad").hide();
$(".cepreuni").hide();

    SelectModalidad($('#idmodalidad').val(),1);



    $("#idmodalidad").click(function(event) {
        var idmodalidad = $(this).val();
        SelectModalidad(idmodalidad,1);

    });
    $("#idmodalidad2").click(function(event) {
        var idmodalidad = $(this).val();
        SelectModalidad(idmodalidad,2);

    });

    function SelectModalidad(idmodalidad,numero) {
        $.ajax({
            url: 'info-modalidad',
            dataType: 'json',
            data: {idmodalidad: idmodalidad},
        })
        .done(function(modalidad) {
            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
            if (modalidad.colegio) {
                $(".Colegio").show();
                $(".Universidad").hide();
            }else{
                $(".Colegio").hide();
                $(".Universidad").show();
            }
            /*Muestra la segunda opcion del cepre UNI*/
            if (numero==1) {
                if (modalidad.codigo == 'ID-CEPRE' && numero==1) {
                    $(".cepreuni").show();
                }else{
                    $(".cepreuni").hide();
                }
            }


        });
    }

    $("#idcolegio").select2({
        width:'auto',
        allowClear: true,
        ajax: {
            url: '{{ url("colegio") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    varschool: params.term // search term
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
        placeholder : 'Seleccione su colegio',
        minimumInputLength: 3,
        templateResult: formatSchool,
        templateSelection: formatSchoolSelection,
        escapeMarkup: function(markup) {
            return markup;
        } // let our custom formatter work
    });

    $("#iduniversidad").select2({
        width:'auto',
        allowClear: true,
        ajax: {
            url: '{{ url("universidad") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                var idmodalidad = $('#idmodalidad').val();
                return {
                    varuni: params.term, // search term
                    varidmodalidad: idmodalidad,
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
        placeholder : 'Seleccione su universidad',
        minimumInputLength: 3,
        templateResult: formatUni,
        templateSelection: formatSchoolSelection,
        escapeMarkup: function(markup) {
            return markup;
        } // let our custom formatter work
    });
    function formatSchool(school){
        if (school.loading) return school.text; //Sin esta columna no carga los items dentro de los campo array

        var localidad = school.distrito;
        if (localidad != null) {
            var lbl_ubigeo = 'Distrito';
            var descripcion_ubigeo = localidad.descripcion;
        }else{
            var lbl_ubigeo = 'Pais';
            var descripcion_ubigeo = school.paises.nombre;
        }

        var markup="<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__title'>" + school.text + "</div>" +
        "<div class='select2-result-repository__description'> " + lbl_ubigeo + " : " + descripcion_ubigeo + "</div>" +
        "<div class='select2-result-repository__description'> Gestion : " + school.gestion + "</div>" +
        "<div class='select2-result-repository__description'> Direccion : " + school.direccion + "</div>" +
        "<div class='select2-result-repository__statistics'>" +
        "</div>"+
        "</div>";
        return markup;

    }
    function formatUni(school){
        if (school.loading) return school.text; //Sin esta columna no carga los items dentro de los campo array

        var localidad = school.distrito;
        if (localidad != null) {
            var lbl_ubigeo = 'Distrito';
            var descripcion_ubigeo = localidad.descripcion;
        }else{
            var lbl_ubigeo = 'Pais';
            var descripcion_ubigeo = school.paises.nombre;
        }
        var markup="<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__title'>" + school.text + "</div>" +
        "<div class='select2-result-repository__description'> " + lbl_ubigeo + " : " + descripcion_ubigeo + "</div>" +
        "<div class='select2-result-repository__description'> Gestion : " + school.gestion + "</div>" +
        "<div class='select2-result-repository__statistics'>" +
        "</div>"+
        "</div>";
        return markup;

    }
    function formatSchoolSelection(school){
        var markup =  school.text;
        return markup;
    }

});

$("#fecha_nacimiento").inputmask("y-m-d", {
    "placeholder": "yyyy-mm-dd"
});
</script>
@stop

@section('plugins-styles')
{!! Html::style(asset('assets/global/plugins/icheck/skins/all.css')) !!}
@stop
@section('plugins-js')
{!! Html::script(asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')) !!}
@stop

