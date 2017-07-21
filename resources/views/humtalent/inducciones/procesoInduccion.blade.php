@extends('material.layouts.dashboard')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Inducciones')

@section('page-title', 'Estado del proceso de inducción:')
@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers font-blue', 'title' => 'Proceso de inducción'])
        {!! Form::open (['id'=>'form-induccion','class'=>'form-horizontal','method'=>'POST']) !!}

                    <div class="form-wizard">
                        <div class="form-body">
                            <ul class="nav nav-pills nav-justified steps">
                                <li>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                        <span class="number"> 1 </span>
                                        <span class="desc">
                                    <i class="fa fa-check"></i> Identificación del personal que ingresa por primera vez </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
                                        <span class="desc">
                                    <i class="fa fa-check"></i> Ejecución de inducción </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab" class="step">
                                        <span class="number"> 3 </span>
                                        <span class="desc">
                                    <i class="fa fa-check"></i> Controles participantes de inducción y reinducción </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab4" data-toggle="tab" class="step">
                                        <span class="number"> 4 </span>
                                        <span class="desc">
                                    <i class="fa fa-check"></i> Evaluación de inducción </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab5" data-toggle="tab" class="step">
                                        <span class="number"> 5 </span>
                                        <span class="desc">
                                    <i class="fa fa-check"></i> Resultados de la evaluación </span>
                                    </a>
                                </li>
                            </ul>
                            <div id="bar" class="progress progress-striped" role="progressbar">
                                <div class="progress-bar progress-bar-success"> </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <h3 class="block">&nbsp;&nbsp;Seleccione si el proceso finalizo exitosamente:</h3>
                                    <div class="form-group">
                                    <div class="col-md-offset-1 col-md-9">
                                    {!! Field::checkboxes('estado1',
                                        ['exito' => 'Se finalizo exitosamente', 'noexito' => 'No ha finalizado'],null,
                                        ['label' => 'Seleccione una opción: ']) !!}
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="tab2">
                                    <h3 class="block">&nbsp;&nbsp;Seleccione si el proceso finalizo exitosamente:</h3>
                                    <div class="form-group">
                                        <div class="col-md-offset-1 col-md-9">
                                            {!! Field::checkboxes('estado2',
                                                ['exito' => 'Se finalizo exitosamente', 'noexito' => 'No ha finalizado'],null,
                                                ['label' => 'Seleccione una opción: ']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="tab3">
                                    <h3 class="block">&nbsp;&nbsp;Seleccione si el proceso finalizo exitosamente:</h3>
                                    <div class="form-group">
                                        <div class="col-md-offset-1 col-md-9">
                                            {!! Field::checkboxes('estado3',
                                                ['exito' => 'Se finalizo exitosamente', 'noexito' => 'No ha finalizado'],null,
                                                ['label' => 'Seleccione una opción: ']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="tab4">
                                    <h3 class="block">&nbsp;&nbsp;Seleccione si el proceso finalizo exitosamente:</h3>
                                    <div class="form-group">
                                        <div class="col-md-offset-1 col-md-9">
                                            {!! Field::checkboxes('estado4',
                                                ['exito' => 'Se finalizo exitosamente', 'noexito' => 'No ha finalizado'],null,
                                                ['label' => 'Seleccione una opción: ']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="tab5">
                                    <h3 class="block">&nbsp;&nbsp;Seleccione si el proceso finalizo exitosamente:</h3>
                                    <div class="form-group">
                                        <div class="col-md-offset-1 col-md-9">
                                            {!! Field::checkboxes('estado5',
                                                ['exito' => 'Se finalizo exitosamente', 'noexito' => 'No ha finalizado'],null,
                                                ['label' => 'Seleccione una opción: ']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="javascript:;" class="btn default button-previous">
                                        <i class="fa fa-angle-left"></i> Atrás </a>
                                    <a href="javascript:;" class="btn btn-outline green button-next"> Continuar
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <a href="javascript:;" class="btn green button-submit"> Finalizar
                                        <i class="fa fa-check"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}



    @endcomponent
@endsection



@push('plugins')

<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/form-wizard.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script type="text/javascript">

    var FormWizard = function () {


        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().bootstrapWizard) {
                    return;
                }

                function format(state) {
                    if (!state.id) return state.text; // optgroup
                    return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
                }

                $("#country_list").select2({
                    placeholder: "Select",
                    allowClear: true,
                    formatResult: format,
                    width: 'auto',
                    formatSelection: format,
                    escapeMarkup: function (m) {
                        return m;
                    }
                });

                var form = $('#form-induccion');
                var error = $('.alert-danger', form);
                var success = $('.alert-success', form);

                form.validate({
                    doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        //account
                        'estado1[]': {
                            required: true,
                            maxlength:1
                        },
                        'estado2[]': {
                            required: true,
                            maxlength:1
                        },
                        'estado3[]': {
                            required: true,
                            maxlength:1
                        },
                        'estado4[]': {
                            required: true,
                            maxlength:1
                        },
                        'estado5[]': {
                            required: true,
                            maxlength:1
                        }

                    },

                    messages: { // custom messages for radio buttons and checkboxes
                        'estado1[]': {
                            required: "Debe seleccionar una opción",
                            maxlength: jQuery.validator.format("Solo puede seleccionar una opción")
                        },
                        'estado2[]': {
                            required: "Debe seleccionar una opción",
                            maxlength: jQuery.validator.format("Solo puede seleccionar una opción")
                        },
                        'estado3[]': {
                            required: "Debe seleccionar una opción",
                            maxlength: jQuery.validator.format("Solo puede seleccionar una opción")
                        },
                        'estado4[]': {
                            required: "Debe seleccionar una opción",
                            maxlength: jQuery.validator.format("Solo puede seleccionar una opción")
                        },
                        'estado5[]': {
                            required: "Debe seleccionar una opción",
                            maxlength: jQuery.validator.format("Solo puede seleccionar una opción")
                        }

                    },

                    errorPlacement: function(error, element) {
                        if (element.is(':checkbox')) {
                            error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                        } else if (element.is(':radio')) {
                            error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                        } else {
                            error.insertAfter(element); // for other inputs, just perform default behavior
                        }
                    },

                    invalidHandler: function (event, validator) { //display error alert on form submit
                        success.hide();
                        error.show();
                        toastr.options.closeButton = true;
                        toastr.options.showDuration= 1000;
                        toastr.options.hideDuration= 1000;
                        toastr.error('Debe corregir algunos campos','Error:')
                        App.scrollTo(error, -200);
                    },

                    highlight: function (element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                    },

                    unhighlight: function (element) { // revert the change done by hightlight
                        $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function (label) {
                        if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                            label
                                .closest('.form-group').removeClass('has-error').addClass('has-success');
                            label.remove(); // remove error label here
                        } else { // display success icon for other inputs
                            label
                                .addClass('valid') // mark the current input as valid and display OK icon
                                .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                        }
                    },

                    submitHandler: function (form) {
                        success.show();
                        error.hide();
                        form.submit();
                        //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                    }

                });

                var displayConfirm = function() {
                    $('#tab3 .form-control-static', form).each(function(){
                        var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                        if (input.is(":radio")) {
                            input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                        }
                        if (input.is(":text") || input.is("textarea")) {
                            $(this).html(input.val());
                        } else if (input.is("select")) {
                            $(this).html(input.find('option:selected').text());
                        } else if (input.is(":radio") && input.is(":checked")) {
                            $(this).html(input.attr("data-title"));
                        } else if ($(this).attr("data-display") == 'payment[]') {
                            var payment = [];
                            $('[name="payment[]"]:checked', form).each(function(){
                                payment.push($(this).attr('data-title'));
                            });
                            $(this).html(payment.join("<br>"));
                        }
                    });
                }

                var handleTitle = function(tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    // set wizard title
                    $('.step-title', $('#form_wizard_1')).text('Paso ' + (index + 1) + ' de ' + total);
                    // set done steps
                    jQuery('li', $('#form_wizard_1')).removeClass("done");
                    var li_list = navigation.find('li');
                    for (var i = 0; i < index; i++) {
                        jQuery(li_list[i]).addClass("done");
                    }

                    if (current == 1) {
                        $('#form_wizard_1').find('.button-previous').hide();
                    } else {
                        $('#form_wizard_1').find('.button-previous').show();
                    }

                    if (current >= total) {
                        $('#form_wizard_1').find('.button-next').hide();
                        $('#form_wizard_1').find('.button-submit').show();
                        displayConfirm();
                    } else {
                        $('#form_wizard_1').find('.button-next').show();
                        $('#form_wizard_1').find('.button-submit').hide();
                    }
                    App.scrollTo($('.page-title'));
                }

                // default form wizard
                $('#form_wizard_1').bootstrapWizard({
                    'nextSelector': '.button-next',
                    'previousSelector': '.button-previous',
                    onTabClick: function (tab, navigation, index, clickedIndex) {
                        return false;

                        success.hide();
                        error.hide();
                        if (form.valid() == false) {
                            return false;
                        }

                        handleTitle(tab, navigation, clickedIndex);
                    },
                    onNext: function (tab, navigation, index) {
                        success.hide();
                        error.hide();

                        if (form.valid() == false) {
                            return false;
                        }

                        handleTitle(tab, navigation, index);
                    },
                    onPrevious: function (tab, navigation, index) {
                        success.hide();
                        error.hide();

                        handleTitle(tab, navigation, index);
                    },
                    onTabShow: function (tab, navigation, index) {
                        var total = navigation.find('li').length;
                        var current = index + 1;
                        var $percent = (current / total) * 100;
                        $('#form_wizard_1').find('.progress-bar').css({
                            width: $percent + '%'
                        });
                    }
                });

                $('#form_wizard_1').find('.button-previous').hide();
                $('#form_wizard_1 .button-submit').click(function () {
                    swal("Inducción finalizada!", "Se ha cambiado el estado del docente", "success");
                }).hide();

                //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
                $('#country_list', form).change(function () {
                    form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
                });
            }

        };

    }();

    var ComponentsSelect2 = function() {

        var handleSelect = function() {

            $.fn.select2.defaults.set("theme", "bootstrap");

            $(".pmd-select2").select2({
                width: null,
                placeholder: "Selecccionar",
            });

        }

        return {
            init: function() {
                handleSelect();
            }
        };

    }();

    jQuery(document).ready(function() {
        $('.caption-subject').append( "<span class='step-title'> Paso 1 de 5 </span>" );
        $('.portlet-sortable').attr("id","form_wizard_1");
        FormWizard.init();
        ComponentsSelect2.init();
    });



</script>

@endpush