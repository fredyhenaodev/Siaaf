<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro del personal'])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ($listaDependencias,['id'=>'form_usuario_create', 'url' => '/forms']) !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <span class="label label-primary">Seleccione la foto del usuario</span>
                                {!! Field::file('CU_UrlFoto') !!}
                                <br><br>
                            </div>

                            {!! Field:: text('PK_CU_Codigo',null,['label'=>'Código interno:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CU_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número cedula del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CU_Nombre1',null,['label'=>'Primer Nombre','class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                                             ['help' => 'Digite el primer nombre del usuario.','icon'=>'fa fa-user']) !!}

                            {!! Field:: text('CU_Nombre2',null,['label'=>'Segundo Nombre:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el segundo nombre del usuario.','icon'=>'fa fa-user'] ) !!}
                        </div>
                        <div class="col-md-6">

                            {!! Field:: text('CU_Apellido1',null,['label'=>'Primer Apellido:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!}

                            {!! Field:: text('CU_Apellido2',null,['label'=>'Segundo Apellido:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!}

                            {!! Field:: text('CU_Telefono',null,['label'=>'Teléfono:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número de teléfono del usuario.','icon'=>'fa fa-phone'] ) !!}

                            {!! Field:: email('CU_Correo',null,['label'=>'Correo electrónico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'90','autocomplete'=>'off'],
                                                             ['help' => 'Digite un correo electronico válido.','icon'=>'fa fa-envelope-open '] ) !!}

                            {!! Field:: text('CU_Direccion',null,['label'=>'Dirección:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'70','autocomplete'=>'off'],
                                                             ['help' => 'Digite la dirección del usuario.','icon'=>'fa fa-building-o'] ) !!}

                            {!! Field::select('FK_CU_IdDependencia', null,['name' => 'SelectDependencia','label'=>'Dependencia: ']) !!}

                            {!! Field::select('FK_CU_IdEstado',['1'=>'Activo', '2'=>'Inactivo'],null,['label'=>'Estado del usuario: ']) !!}
                        </div>
                    </div>
                        

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">                                
                                <a href="javascript:;" class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>

                                {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endcomponent
</div>
<!-- file script -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></scripts>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        /* Configuración del Select cargado de la BD */

        var $widget_select_SelectDependencia = $('select[name="SelectDependencia"]');

        var route_Dependencia = '{{ route('parqueadero.usuariosCarpark.listDependencias') }}';
        $.get(route_Dependencia, function(response, status){
            $( response.data ).each(function( key,value ) {
                $widget_select_SelectDependencia.append(new Option(value.CD_Dependencia, value.PK_CD_IdDependencia));
            });
            $widget_select_SelectDependencia.val([]);
        });


        /*Configuracion de Select*/
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

        var createUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('parqueadero.usuariosCarpark.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    var File = document.getElementById("CU_UrlFoto");

                    formData.append('PK_CU_Codigo', $('input:text[name="PK_CU_Codigo"]').val());
                    formData.append('CU_Cedula', $('input:text[name="CU_Cedula"]').val());
                    formData.append('CU_Nombre1', $('input:text[name="CU_Nombre1"]').val());
                    formData.append('CU_Nombre2', $('input:text[name="CU_Nombre2"]').val());
                    formData.append('CU_Apellido1', $('input:text[name="CU_Apellido1"]').val());
                    formData.append('CU_Apellido2', $('input:text[name="CU_Apellido2"]').val());
                    formData.append('CU_Telefono', $('input:text[name="CU_Telefono"]').val());
                    formData.append('CU_Correo', $('input[name="CU_Correo"]').val());
                    formData.append('CU_Direccion', $('input:text[name="CU_Direccion"]').val());

                    formData.append('CU_UrlFoto',File.files[0]);
                                        
                    formData.append('FK_CU_IdEstado', $('select[name="FK_CU_IdEstado"]').val());
                    formData.append('FK_CU_IdDependencia', $('select[name="SelectDependencia"]').val());
                    
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
                                $('#form_usuario_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form = $('#form_usuario_create');
        var formRules = {
            CU_UrlFoto:{required: true}, 
            CU_Cedula: {minlength: 8, maxlength: 10,required: true, number:true},
            PK_CU_Codigo:{required: true, minlength: 9, maxlength: 9, number:true},
            CU_Nombre1:{required: true},            
            CU_Apellido1:{required: true},              
            CU_Correo:{required: true, email:true},
            CU_Direccion:{required: true},
            FK_CU_IdDependencia:{required: true},
            FK_CU_IdEstado:{required: true},
        };
        FormValidationMd.init(form, formRules, false, createUsers());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>