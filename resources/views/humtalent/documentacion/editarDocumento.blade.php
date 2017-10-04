    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos del documento'])
            <div class="col-md-6">
                <div class="btn-group">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon back">
                        <i class="fa fa-arrow-circle-left"></i>Volver
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                        {!! Form::model ($documento, ['id'=>'form-document_update', 'url'=> ['/forms'], 'role'=>"form"]) !!}
                                        {!! Field::hidden('PK_DCMTP_Id_Documento',$documento->PK_DCMTP_Id_Documento) !!}
                                        {!! Field:: text('DCMTP_Nombre_Documento',null,['label'=>'Nombre Del Documento:','class'=> 'form-control',
                                                         'id'=>'name','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                        ['help'=>'Digite el nombre del documento.','icon'=>' fa fa-credit-card']) !!}
                                        {!! Field::select('DCMTP_Tipo_Documento',
                                                    ['EPS' => 'EPS', 'Caja de compensación' => 'Caja de compensación'],
                                                    null,
                                                    [ 'label' => 'Seleccionar el tipo de documento']) !!}
                        <div class="row">
                            <div class="form-actions">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
                                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
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

        var createDoc = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.document.update') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('DCMTP_Nombre_Documento', $('input:text[name="DCMTP_Nombre_Documento"]').val());
                    formData.append('DCMTP_Tipo_Documento', $('select[name="DCMTP_Tipo_Documento"]').val());
                    formData.append('PK_DCMTP_Id_Documento', $('[name="PK_DCMTP_Id_Documento"]').val());
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
                                $('#form-document_update')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('talento.humano.document.index.ajax') }}';
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
        var form = $('#form-document_update');
        var formRules = {
            DCMTP_Nombre_Documento: {required: true},
            DCMTP_Tipo_Documento: {required: true},
        };
        FormValidationMd.init(form,formRules,false,createDoc());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.document.index.ajax') }}';
            $(".content-ajax").load(route);
        });

        $( ".back" ).on('click', function (e) {
            //e.preventDefault();
            var route = '{{ route('talento.humano.document.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>