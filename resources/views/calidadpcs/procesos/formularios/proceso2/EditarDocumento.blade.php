<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Etapa de planificacion:'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
            ],
        ])
        <div class="row">
        <div class="col-md-12 col-md-offset-0">
        <h4 style="margin-top: 0px;">Editar proceso: Desarrollar plan para la dirección del proyecto.</h4>
            <br>
                <div class="panel-group accordion" id="date-range">
                    <!--Primer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_1"><strong>CMMI:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Nivel de madurez:</strong> 2. <br><br><strong>Meta especifica:</strong> Gestionar los requisitos.<br><br><strong>Propósito:</strong> El propósito de la Gestión de Requisitos (REQM) es gestionar los requisitos de los productos y los componentes de producto del proyecto, y asegurar la alineación entre esos requisitos, y los planes y los productos de trabajo del proyecto.
                                <br><br><strong>Notas introductorias: </strong> Los procesos de gestión de requisitos gestionan todos los requisitos recibidos o generados por el proyecto, incluyendo tanto los requisitos técnicos como los no técnicos, así como los requisitos impuestos al proyecto por la organización. En particular, si se implementa el área de proceso 
                                Desarrollo de Requisitos, sus procesos generarán requisitos de producto y de componente de producto que también serán gestionados por los procesos de gestión de requisitos. En todas las áreas de proceso, cuando se utilizan los términos “producto” y “componente de producto”, sus significados previstos también incluyen los servicios, 
                                los sistemas de servicio y sus componentes. Cuando las áreas de proceso Gestión de Requisitos, Desarrollo de Requisitos y Solución Técnica están implementadas, sus procesos asociados pueden estar estrechamente relacionados y realizarse de manera concurrente. El proyecto realiza los pasos apropiados para asegurar que el conjunto de 
                                requisitos aprobados se gestiona para dar soporte a las necesidades de planificación y de ejecución del proyecto. Cuando un proyecto recibe requisitos de un proveedor de requisitos aprobado, éstos se revisan con dicho proveedor para resolver las cuestiones y para prevenir malentendidos antes de que los requisitos se incorporen en 
                                los planes del proyecto. Una vez que el proveedor y el receptor de los requisitos alcanzan un acuerdo, se obtiene un compromiso sobre los requisitos por parte de los participantes en el proyecto. El proyecto gestiona los cambios a los requisitos a medida que evolucionan e identifica inconsistencias que ocurren entre los planes, los 
                                productos de trabajo y los requisitos.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Segundo acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_2"><strong>SCRUM:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                    Roles Scrum que son necesarios para este proceso:<br><strong>Stakeholder: </strong>{{ $equipoScrum[2]['CE_Nombre_Persona'] }}<br><strong>Product Owner: </strong>{{ $equipoScrum[1]['CE_Nombre_Persona'] }}<br><strong>Scrum Master: </strong>{{ $equipoScrum[0]['CE_Nombre_Persona'] }}.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tercer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_3"><strong>PMBOK:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                    <strong>Gestión de la Integración del Proyecto: </strong>La Gestión de la Integración del Proyecto incluye los procesos y actividades necesarios para identificar, definir, combinar, unificar y coordinar los diversos procesos y actividades de dirección del proyecto dentro de los Grupos de Procesos de la Dirección de Proyectos. 
                                    En el contexto de la dirección de proyectos, la integración incluye características de unificación, consolidación, comunicación y acciones integradoras cruciales para que el proyecto se lleve a cabo de manera controlada, de modo que se complete, que se manejen con éxito las expectativas de los interesados y se cumpla con los 
                                    requisitos. La Gestión de la Integración del Proyecto implica tomar decisiones en cuanto a la asignación de recursos, equilibrar objetivos y alternativas contrapuestas y manejar las interdependencias entre las Áreas de Conocimiento de la dirección de proyectos. Los procesos de la dirección de proyectos se presentan normalmente 
                                    como procesos diferenciados con interfaces definidas, aunque en la práctica se superponen e interactúan entre ellos de formas que no pueden detallarse en su totalidad dentro de la Guía del PMBOK®.<br><br>
                                    <strong>Desarrollar el Acta de Constitución del Proyecto: </strong>Es el proceso de desarrollar un documento que autoriza formalmente la existencia de un proyecto y confiere al director del proyecto la autoridad para asignar los recursos de la organización a las actividades del proyecto.<br><br>
                                    <strong>Gestión de los interesados del proyecto: </strong>La Gestión de los Interesados del Proyecto incluye los procesos necesarios para identificar a las personas, grupos u organizaciones que pueden afectar o ser afectados por el proyecto, para analizar las expectativas de los interesados y su impacto en el proyecto, y para 
                                    desarrollar estrategias de gestión adecuadas a fin de lograr la participación eficaz de los interesados en las decisiones y en la ejecución del proyecto. La gestión de los interesados también se centra en la comunicación continua con los interesados para comprender sus necesidades y expectativas, abordando los incidentes en el 
                                    momento en que ocurren, gestionando conflictos de intereses y fomentando una adecuada participación de los interesados en las decisiones y actividades del proyecto. La satisfacción de los interesados debe gestionarse como uno de los objetivos clave del proyecto.<br><br>
                                    <strong>Identificar a los Interesados: </strong>El proceso de identificar las personas, grupos u organizaciones que podrían afectar o ser afectados por una decisión, actividad o resultado del proyecto, así como de analizar y documentar información relevante relativa a sus intereses, participación, interdependencias, influencia 
                                    y posible impacto en el éxito del proyecto.<br><br>
                                    <strong>Planificar la Gestión de los Interesados: </strong>El proceso de desarrollar estrategias de gestión adecuadas para lograr la participación eficaz de los interesados a lo largo del ciclo de vida del proyecto, con base en el análisis de sus necesidades, intereses y el posible impacto en el éxito del proyecto.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                {!! Form::model([[$idProceso],[$infoProceso],[$idProyecto]],['id'=>'form_update_proyecto', 'url' => '/forms']) !!}
                    <div class="form-body">
                        <div class="row">
                            <h3>Informacion del proceso</h3><br>
                                <div class="col-md-12">

                                    {!! Field:: hidden ('PK_CP_Id_Proyecto', $idProyecto)!!}

                                    {!! Field:: hidden ('PK_CP_Id_Proceso', $idProceso)!!}

                                    {!! Field:: hidden ('idAlcance', $infoProceso['PK_CPPD_Id_Direccion'])!!}

                                    {!! Field::textArea('Alcance',$infoProceso['CPPD_Alcance'],['label' => 'Alcance:', 'required', 'auto' => 'off', 'max' => '300', "rows" => '2'],
                                        ['help' => 'Escribe el alcance del proyecto.', 'icon' => 'fa fa-quote-right']) !!}
                                </div>
                        </div><br>
                        <div class="row">
                            <h3>Requerimientos</h3>
                            <div class="actions">
                        <a href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Crear un nuevo proyecto"><i class="glyphicon glyphicon-plus"></i>Agregar</a>
                        </div><br>
                            <div class="col-md-12">
                                @component('themes.bootstrap.elements.tables.datatables',['id' => 'tablaRequerimientos'])
                                    @slot('columns', [
                                        '#',
                                        'Requerimiento',
                                        ''
                                    ])
                                @endcomponent
                            </div>
                        </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>
                                {{ Form::submit('Actualizar', ['class' => 'btn blue']) }}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_create" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h4>Agregar requerimiento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('Requerimiento',null,['label'=>'Requerimiento:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del objetivo.', 'icon' => 'fa fa-tag'] ) !!}
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
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_edit" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_edit', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h4>Editar requerimiento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                {!! Field:: hidden ('idRequerimiento') !!}

                                   {!! Field:: text('Requerimiento_edit',null,['label'=>'Requerimiento:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del objetivo.', 'icon' => 'fa fa-tag'] ) !!}
                                  
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Actualizar', ['class' => 'btn blue']) !!} 
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

<!-- file script -->
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type = "text/javascript" > </script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

    jQuery(document).ready(function () {

        var table, url, columns;
        table = $('#tablaRequerimientos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaRequermientos')}}"+ "/"+ {{$idProyecto}};
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CPR_Nombre_Requerimiento', name: 'CPR_Nombre_Requerimiento'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-info editar"  title="Editar este objetivo" ><i class="fa fa-pencil-square-o"></i></a>   <a href="javascript:;" class="btn btn-danger remove"  title="Eliminar este requerimiento" ><i class="fa fa-trash"></i></a>',
                data: 'action',
                name: 'Acciones',
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
        
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = "{{route('calidadpcs.procesosCalidad.deleteRequerimiento')}}"+"/"+ dataTable.PK_CPR_Id_Requerimientos;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar el requerimiento seleccionado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun requerimiento", "error");
                    }
                });

        });
        
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });

        var editarProyecto = function () {
            return {
                init: function () {
                    var route = '{{ route('calidadpcs.procesosCalidad.updateProceso2') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();

                    formData.append('idAlcance', $('input:hidden[name="idAlcance"]').val());
                    formData.append('Alcance', $('#Alcance').val());
                   
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
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_update_proyecto')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
                                location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
                                //$(".content-ajax").load(route);
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
        var form = $('#form_update_proyecto');
        var formRules = {
            CP_Nombre_Proyecto: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CP_Fecha_Inicio: {required: true, minlength: 3, maxlength: 20},
            CP_Fecha_Final: {required: true, minlength: 3, maxlength: 20},
            CE_Nombre_2: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
        };
        var formMessage = {
            CP_Nombre_Proyecto: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CP_Nombre_Proyecto: {letters: 'Los numeros no son válidos'},
            CE_Nombre_1: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_1: {letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, editarProyecto());

        $(".create").on('click', function(e) {
            e.preventDefault();
            $('#modal_create').modal('toggle');
        });

        var createModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.storeRequerimiento') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                                        
                    formData.append('Requerimiento', $('input:text[name="Requerimiento"]').val());
                    formData.append('idProyecto', {{$idProyecto}});

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
                                // table.ajax.reload();
                                table.ajax.reload();
                                $('#modal_create').modal('hide');
                                $('#form_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal = $('#form_create');
        var rules_create_modal = {
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal,rules_create_modal,false,createModal());
        
        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idRequerimiento"]').val(dataTable.PK_CPR_Id_Requerimientos);
            $("#Requerimiento_edit").val(dataTable.CPR_Nombre_Requerimiento);
            $('#modal_edit').modal('toggle');
        });

        var EditModal = function () {
            return{
                init: function () {
                    var route = "{{ route('calidadpcs.procesosCalidad.updateRequerimiento') }}";
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                                        
                    formData.append('idRequerimiento', $('input:hidden[name="idRequerimiento"]').val());
                    formData.append('Requerimiento', $('input:text[name="Requerimiento_edit"]').val());
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
                                table.ajax.reload();
                                $('#modal_edit').modal('hide');
                                $('#form_edit')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_edit_modal = $('#form_edit');
        var rules_edit_modal = {
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_edit_modal,rules_edit_modal,false,EditModal());



        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
            //$(".content-ajax").load(route);
        });

    });
</script>