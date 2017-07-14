@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Anteproyectos')


@section('page-title', 'Anteproyectos')

@section('page-description', 'Anteproyectos registrados')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Lista de Anteproyectos'])
    <div class="row">
        
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{{ route('min.create') }}">
                    <button id="sample_editable_1_new" class="btn green" style="margin-bottom:-8px;"> Add New
                        <i class="fa fa-plus"></i>
                    </button>
                </a> 
            </div>
        </div>
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyecto'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id',
                    'Titulo',
                    'Palabras Clave',
                    'Duracion',
                    'Fecha Radicacion',
                    'Fecha Limite',
                    'Estado',
                    'Min',
                    'Requerimientos',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    @endcomponent
@endsection



@push('plugins')
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script>
jQuery(document).ready(function () {

/*
* Referencia https://datatables.net/reference/option/
*/

var table, url;
table = $('#lista-anteproyecto');
url = "{{ route('anteproyecto.list') }}";

    table.DataTable({
       lengthMenu: [
           [5, 10, 25, 50, -1],
           [5, 10, 25, 50, "Todo"]
       ],
       responsive: true,
       colReorder: true,
       processing: true,
       serverSide: true,
       ajax: url,
       language: {
           "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
           "sLengthMenu": "Mostrar _MENU_ registros",
           "sZeroRecords": "No se encontraron resultados",
           "sEmptyTable": "Ningún dato disponible en esta tabla",
           "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
           "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
           "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
           "sInfoPostFix": "",
           "sSearch": "Buscar:",
           "sUrl": "",
           "sInfoThousands": ",",
           "sLoadingRecords": "Cargando...",
           "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Último",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
           },
           "oAria": {
               "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
           }
       },
       columns:[
           {data: 'DT_Row_Index'},
           {data: 'PK_NPRY_idMinr008', "visible": false },
           {data: 'NPRY_Titulo', name: 'Title'},
           {data: 'NPRY_Keywords', name: 'Keywords'},
           {data: 'NPRY_Duracion', name: 'Duracion'},
           {data: 'NPRY_FechaR', name: 'FechaR',className:'none'},
           {data: 'NPRY_FechaL', name: 'FechaL',className:'none'},
           {data: 'NPRY_Estado', name: 'Estado'},
           {data: 'RDCN_Min', name: 'min',className:'none'},
           {data: 'RDCN_Requerimientos', name: 'requerimientos',className:'none'},
           {   data:"PK_NPRY_idMinr008",
               name:'action',
               title:'Acciones',
               orderable: false,
               searchable: false,
               exportable: false,
               printable: false,
               className: '',   
               render: function ( data, type, full, meta ) {
                 return '<a href="/gesap/min/'+data+'/edit" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="/gesap/anteproyecto/asignar/'+data+'" class="btn btn-simple btn-success btn-icon edit"><i class="icon-users"></i></a><form action="/gesap/min/'+data+'" method="POST" style="display:initial;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{csrf_token()}}"><button type="submit" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></button></form>';
                }
               
           }
       ],
       buttons: [
           { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
           { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
           { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
           { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
           { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
           { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
           {text: '<i class="fa fa-refresh"></i>', className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
               }
           }

       ],
       pageLength: 10,
       dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });
});
</script>
@endpush