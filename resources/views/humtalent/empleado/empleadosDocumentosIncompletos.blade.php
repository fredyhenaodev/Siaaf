@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Consulta de Documentación')

@section('page-title', 'Empleados con documentación incompleta.')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Empleados:'])

            @if($estado == 'Activada')
                {!! link_to_route('humtalent.notificaciones.desactivarDocumentosIncompletos',
                                $title = 'Desactivar notificaciones' , $parameters = 'Documentos incompletos') !!}
            @else
                {!! link_to_route('humtalent.notificaciones.activarDocumentosIncompletos',
                                $title = 'Activar notificaciones' , $parameters = 'Documentos incompletos') !!}
            @endif
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'])
                        @slot('columns', [
                            '#',
                            'Nombres',
                            'Apellidos',
                            'Cédula',
                            'Teléfono',
                            'Email',
                            'Rol ',
                            'Área',
                            'Acciones'
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">


    jQuery(document).ready(function () {

        @if(Session::has('message'))
            var type="{{Session::get('alert-type','info')}}"
            switch(type){
                case 'info':
                    toastr.options.closeButton = true;
                    toastr.info("{{Session::get('message')}}",'Modificación exitosa:');
                    break;
            }
        @endif


        var table, url,columns;
        table = $('#lista-empleados');
        url = "{{ route('talento.humano.notificaciones.listaEmpleadosDocumentosIncompletos')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'personas.PRSN_Nombres', name: 'Nombres'},
            {data: 'personas.PRSN_Apellidos', name: 'Apellidos'},
            {data: 'personas.PK_PRSN_Cedula', name: 'Cedula'},
            {data: 'personas.PRSN_Telefono', name: 'Teléfono'},
            {data: 'personas.PRSN_Correo', name: 'Correo Electronico'},
            {data: 'personas.PRSN_Rol', name: 'Rol'},
            {data: 'personas.PRSN_Area', name: 'Área'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-primary documents" ><i class="fa fa-book"></i></a>',
                data:'action',
                name:'action',
                title:'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority:2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        table.on('click', '.documents', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $.ajax({
            }).done(function(){
                window.location.href='{{ route('talento.humano.notificaciones.consultarDocsRadicados') }}'+'/'+dataTable.personas.PK_PRSN_Cedula;
            });
        });
    });
</script>
@endpush