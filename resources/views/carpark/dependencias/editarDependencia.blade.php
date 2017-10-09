    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos del personal'])
            <div class="col-md-6">
                <div class="btn-group">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon back">
                        <i class="fa fa-arrow-circle-left"></i>Volver
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                {!! Form::model ($dependenciaRegistrada, ['id'=>'form_dependencia_update', 'url' => '/forms'])  !!}

                    <div class="form-body">                    

                        {!! Field:: text('PK_CD_IdDependencia',null,['label'=>'Código de la dependencia','class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly']) !!}

                        {!! Field:: text('CD_Dependencia',null,['label'=>'Nombre de la dependencia:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                                         ['help' => 'Digite un nombre valido para la dependencia.','icon'=>'fa fa-user'] ) !!}                        

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0">                                    
                                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                        Cancelar
                                    </a>
                                    {{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
        @endcomponent
    </div>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {

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

    var createDependencia = function () {
        return{
            init: function () {
                var route = '{{ route('parqueadero.dependenciasCarpark.update') }}';
                var type = 'POST';
                var async = async || false;

                var formData = new FormData();
                formData.append('PK_CD_IdDependencia', $('input:text[name="PK_CD_IdDependencia"]').val());
                formData.append('CD_Dependencia', $('input:text[name="CD_Dependencia"]').val());
                
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
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        console.log(response);
                        if (request.status === 200 && xhr === 'success') {
                            $('#form_dependencia_update')[0].reset(); //Limpia formulario
                            UIToastr.init(xhr , response.title , response.message  );
                            App.unblockUI('.portlet-form');
                            var route = '{{ route('parqueadero.dependenciasCarpark.index.ajax') }}';
                            $(".content-ajax").load(route);
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
    var form = $('#form_dependencia_update');
    var formRules = {
        PK_CD_IdDependencia: {required: true},
        CD_Dependencia: {required: true, maxlength: 50, minlength: 5},        
    };

    FormValidationMd.init(form,formRules,false,createDependencia());

    $('.button-cancel').on('click', function (e) {
        e.preventDefault();
        var route = '{{ route('parqueadero.dependenciasCarpark.index.ajax') }}';
        $(".content-ajax").load(route);
    });

   $( ".back" ).on('click', function (e) {
       e.preventDefault();
       var route = '{{ route('parqueadero.dependenciasCarpark.index.ajax') }}';
       $(".content-ajax").load(route);
   });


});

</script>