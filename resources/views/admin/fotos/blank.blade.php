@extends('layouts.admin')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-file-image-o"></i>Editor de Fotos </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::open(['route'=>'admin.pagos.store','method'=>'POST']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('lblDatos', 'Foto que desea visualizar', ['class'=>'form-group']) !!}
                    </div>
                    <div class="col-md-2">
                         {!!Form::text('dni', null , ['class'=>'form-control','placeholder'=>'DNI del Alumno']);!!}
                    </div>
                    <div class="col-md-4 text-left">
                        {!!Form::enviar('Buscar')!!}
                    </div>
                </div>{{-- row --}}
            </div>
            <p></p>
        {!! Form::close() !!}
            <div class="row">
                <div class="col-md-12">
                {!!Form::boton('Cargar',route('admin.fotos.index'),'green-meadow','fa fa-cloud-download')!!}
                </div>
            </div><!--row-->
            <p></p>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <a href="javascript:;" class="thumbnail">
                        <img src="{{ asset('/storage/avatar/nofoto.jpg') }}" style="height: 500px; width: 400px; display: block;"> </a>
                </div><!--span-->
            </div><!--row-->
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

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



