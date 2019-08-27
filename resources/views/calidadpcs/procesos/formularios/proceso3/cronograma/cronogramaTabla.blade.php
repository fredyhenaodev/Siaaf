<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Cronograma:'])
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="actions">
                <a href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Crear un nuevo proyecto"><i class="glyphicon glyphicon-plus"></i>Agregar sprint</a>
                <br>
            </div>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables',['id' => 'listaActividades'])
            @slot('columns', [
            '#',
            'Nombre Sprint',
            'Requerimientos',
            'Recurso',
            'Duracion',
            ''
            ])
            @endcomponent
        </div>
        <div class="col-md-12">
            <div class="note note-success">
                <h4 class="block">Tener en cuenta!</h4>
                <p> Recuerda que para avanzar deben estar completos los datos de la tabla</p>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12 col-md-offset-4">
                    @permission('CALIDADPCS_CREATE_PROJECT')<a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                    {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                    @endpermission
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal-create-permission" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Crear sprint</h1>
                            <h3>Numero de semanas disponibles: <span id="num"></span></h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field:: hidden ('FK_CPP_Id_Proyecto', $infoProyecto[0]['PK_CP_Id_Proyecto'])!!}

                                    {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                    <div class="form-group form-md-line-input" style="padding-top: 0px;">
                                        <div class="input-icon">
                                            <label for="lista_requerimientos" class="control-label">Requerimientos:</label>
                                            <select id="lista_requerimientos" name="lista_requerimientos" class="selectpicker" multiple data-size="5" title="Seleccione por lo menos un requerimiento" data-width="100%">
                                                @foreach($requerimientos as $key => $name)
                                                <option value="{{$key}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input" style="padding-top: 0px;">
                                        <div class="input-icon">
                                            <label for="lista_integrantes" class="control-label">Integrantes:</label>
                                            <select id="lista_integrantes" name="lista_integrantes" class="selectpicker" multiple data-size="5" title="Seleccione por lo menos un responsable" data-width="100%">
                                                @foreach($integrantes as $key => $name)
                                                <option value="{{$key}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {!! Field:: text('numero_semanas',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcomponent
</div>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var semDiferencia;
    var subtotal = 0;
    var fechaEmision = moment('{{$infoProyecto[0]['CP_Fecha_Inicio']}}');
    var fechaExpiracion = moment('{{$infoProyecto[0]['CP_Fecha_Final']}}');

    
    var actualizarSemanas = function() {
        semDiferencia = fechaExpiracion.diff(fechaEmision, 'weeks');
        url = "{{route('calidadpcs.procesosCalidad.tablaCronograma')}}" + "/" + {{$idProyecto}};
        $.get(url, function(data) {
            $.each(data.data, function(index, value) {
                console.log(value.CPC_Duracion);
                subtotal += parseInt(value.CPC_Duracion);
            });
            semDiferencia = (semDiferencia - subtotal);
            console.log(semDiferencia);
            var createProyecto = function() {
            return {
                init: function() {
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso3') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();


                    formData.append('FK_CPP_Id_Proyecto', $('input:hidden[name="FK_CPP_Id_Proyecto"]').val());
                    formData.append('CPC_Nombre_Sprint', $('input:text[name="CPC_Nombre_Sprint"]').val());
                    formData.append('CPC_Requerimiento', $('#lista_requerimientos').val());
                    formData.append('CPC_Recurso', $('#lista_integrantes').val());
                    formData.append('CPC_Duracion', $('input:text[name="numero_semanas"]').val());

                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function() {

                        },
                        success: function(response, xhr, request) {
                            if (response.data == 422) {
                                xhr = "warning"
                                UIToastr.init(xhr, response.title, response.message);

                            } else {
                                if (request.status === 200 && xhr === 'success') {
                                    var table = $('#listaActividades');
                                    table = table.DataTable();
                                    table.ajax.reload();
                                    actualizarSemanas();
                                    $('#modal-create-permission').modal('hide');
                                    $('#from_permissions_update')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);

                                }
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form = $('#from_permissions_update');
        var formRules = {
            CPC_Nombre_Sprint: {
                required: true,
                minlength: 2,
                maxlength: 50,
            },
            numero_semanas: {
                required: true,
                min: 1,
                max: semDiferencia,
            },
            lista_requerimientos: {
                required: true,
            },
            lista_integrantes: {
                required: true,
            },
        };
        var formMessage = {

        };
        FormValidationMd.init(form, formRules, formMessage, createProyecto());
            $("#num").text(semDiferencia);
            
        });
    }
    jQuery(document).ready(function() {
        $('.selectpicker').selectpicker();
        actualizarSemanas();
        var table, url, columns;
        table = $('#listaActividades');
        url = "{{route('calidadpcs.procesosCalidad.tablaCronograma')}}" + "/" + {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPC_Nombre_Sprint',
                name: 'CPC_Nombre_Sprint'
            },
            {
                data: 'RequerimientoNombre',
                name: 'RequerimientoNombre'
            },
            {
                data: 'RecursoNombre',
                name: 'RecursoNombre'
            },
            {
                data: 'CPC_Duracion',
                name: 'CPC_Duracion'
            },

            {
                defaultContent: '<a href="javascript:;" title="Editar" id="myb" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>',
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

        $(".create").on('click', function(e) {
            e.preventDefault();
            $('#modal-create-permission').modal('toggle');
            // $tr = $(this).closest('tr');
        });

        // table.on('click', '.edit', function(e) {
        //     e.preventDefault();
        //     $('#modal-update-permission').modal('toggle');
        //     $tr = $(this).closest('tr');
        // });
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });
       
    });
  
</script>