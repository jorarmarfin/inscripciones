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
                <i class="fa fa-money"></i>Pagos </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::open(['route'=>'admin.pagos.store','method'=>'POST','files'=>'true']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('lblDatos', 'Datos', ['class'=>'form-group']) !!}
                    </div>
                    <div class="col-md-4">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="input-group input-large">
                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                    <span class="fileinput-filename"> </span>
                                </div>
                                <span class="input-group-addon btn default btn-file">
                                    <span class="fileinput-new"> Seleccionar </span>
                                    <span class="fileinput-exists"> Cambiar </span>
                                    {{ Form::file('file', []) }}
                                </span>
                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-left">
                        {!!Form::enviar('Cargar')!!}
                    </div>
                </div>{{-- row --}}
            </div>
            <p></p>
        {!! Form::close() !!}
        <p></p>{{-- asset('/storage/carteras/UNIADMIS.txt') --}}
        {!!Form::boton('Crear Cartera',route('admin.cartera.create'),'green-meadow','fa fa-file-image-o')!!}
		{!!Form::boton('Descargar Cartera',route('admin.cartera.download'),'green-seagreen','fa fa-cloud-download')!!}
        {!!Form::botonmodal('Crear Pago','#PagoCreate','blue','fa fa-plus')!!}
        <p></p>
			<table class="table table-bordered table-hover Recaudacion">
			    <thead>
			        <tr>
			            <th> Recibo </th>
			            <th> Servicio </th>
			            <th> Descripcion </th>
			            <th> Monto </th>
			            <th> Fecha </th>
			            <th> Codigo </th>
			            <th> Cliente </th>
			            <th> postulante </th>
			            <th> Opciones </th>
			        </tr>
			    </thead>
			    <tbody>

			    </tbody>
			</table>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

<div class="modal fade" id="PagoCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Crea Pago</h4>
            </div>
            {!! Form::open(['route'=>'admin.pagos.create','method'=>'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('lblDNI', 'Numero de DNI');!!}
                    {!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Numero de DNI','maxlength'=>'8']);!!}
                </div>
            </div>
            <div class="modal-footer">
                {!!Form::enviar('Guardar')!!}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@stop

@section('js-scripts')
<script>
$('.Recaudacion').dataTable({
    "language": {
        "emptyTable": "No hay datos disponibles",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
        "search": "Buscar Postulante :",
        "lengthMenu": "_MENU_ registros"
    },
    "bProcessing": true,
    "sAjaxSource": '{{ url('admin/pagos-lista') }}',
    "pagingType": "bootstrap_full_number",
    "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                    'targets': '_all'
                },
                {
                    'targets':7,
                    'render': function ( data, type, full, meta ) {
                      return data.paterno+'-'+data.materno+', '+data.nombres;
                    }
                },
                {
                    'targets':8,
                    'render': function ( data, type, full, meta ) {
                      return '<a href="postulante/'+data+'/edit" title="Editar"class="btn btn-icon-only green-haze" ><i class="fa fa-edit"></i></a>';
                    }
                }
            ],
    "columns": [
            { "data": "recibo","defaultContent": "" },
            { "data": "servicio","defaultContent": "" },
            { "data": "descripcion","defaultContent": "" },
            { "data": "monto","defaultContent": "" },
            { "data": "fecha","defaultContent": "" },
            { "data": "codigo","defaultContent": "" },
            { "data": "nombrecliente","defaultContent": "" },
            { "data": "postulantes","defaultContent": "" },
            { "data": "id","defaultContent": "" },
        ],
    "order": [1,"asc"]
});
</script>
@stop

@section('plugins-styles')
{!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
{!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
{!! Html::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}

@stop

@section('plugins-js')
{!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
{!! Html::script('assets/global/scripts/datatable.js') !!}
{!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
{!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
{!! Html::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

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


