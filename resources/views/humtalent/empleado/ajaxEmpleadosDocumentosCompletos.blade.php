<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Empleados:'])
        @if($estado == 'Activada')
            <div class="row">
                <div class="form-group">
                    {!! Form::open (['id'=>'form-desactivar', 'url'=> ['/forms']]) !!}
                    {!! Field::hidden('tipo', "Documentos completos") !!}
                    {!! Form::submit('Desactivar Notificaciones',['class'=>'btn blue','btn-icon remove']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        @else
            <div class="row">
                <div class="form-group">
                    {!! Form::open (['id'=>'form-activar', 'url'=> ['/forms']]) !!}
                    {!! Field::hidden('tipo', "Documentos completos") !!}
                    {!! Form::submit('Activar Notificaciones',['class'=>'btn blue','btn-icon remove']) !!}
                </div>
                {!! Form::close() !!}
            </div>
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

<!-- DataTable, Validation y Toastr functions -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {

        var table, url, columns;
        table = $('#lista-empleados');
        url = "{{ route('talento.humano.notificaciones.listaEmpleadosDocumentosCompletos')}}";
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
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        table.on('click', '.documents', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route = '{{ route('talento.humano.notificaciones.consultarDocsRadicados') }}' + '/' + dataTable.personas.PK_PRSN_Cedula + '/EPS';
            $(".content-ajax").load(route);
        });

        var desactivarNotify = function () {
            return {
                init: function () {
                    var route = '{{ route('humtalent.notificaciones.desactivarDocumentosCompletos') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('tipo', $('[name="tipo"]').val());

                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('humtalent.empleado.notificaciones.empleadosDocumentosCompletos.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form1 = $('#form-desactivar');
        var rules1 = {
            tipo: {required: true},
        };

        FormValidationMd.init(form1, rules1, false, desactivarNotify());


        var activarNotify = function () {
            return {
                init: function () {
                    var route = '{{ route('humtalent.notificaciones.activarDocumentosCompletos') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('tipo', $('[name="tipo"]').val());

                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('humtalent.empleado.notificaciones.empleadosDocumentosCompletos.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form2 = $('#form-activar');
        var rules2 = {
            tipo: {required: true},
        };
        FormValidationMd.init(form2, rules2, false, activarNotify());
    });
</script>