<template>
    <div class="row">
        <div class="col-md-12">
            <portlet icon="fa fa-money" :title="portlet.title">
                <template slot="actions">
                    <a class="btn btn-circle btn-icon-only btn-default tooltips" data-placement="top" data-original-title="¿Qué puedo hacer?" data-toggle="modal" href="#modal-faq">
                        <i class="fa fa-question"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default tooltips" data-placement="top" data-original-title="Generar Reportes" data-toggle="modal" href="#modal-report">
                        <i class="fa fa-file-pdf-o"></i>
                    </a>
                </template>
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12 margin-bottom-40">
                            <a class="btn btn-success" data-toggle="modal" href="#modal-check" id="create-button" v-text="portlet.btnText"></a>
                        </div>
                        <div class="col-md-12">
                            <vue-data-table
                                    :id="table.id"
                                    :columns="table.columns">
                            </vue-data-table>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-12">
            <empty-sortable-portlet></empty-sortable-portlet>
        </div>
        <vue-modal id="modal-faq" modal-class="container" title="¿Qué puedo hacer?">
            <template slot="body">
                <div class="col-md-12 text-center">
                    <youtube video-id="LmEZ0CFjfFk" ></youtube>
                    <youtube video-id="Zpsw1Gbow80" ></youtube>
                    <p class="text-center">Video de Ayuda</p>
                </div>
            </template>
        </vue-modal>
        <vue-modal id="modal-check" :title="portlet.title">
            <template slot="body">
                <form @submit.prevent="createCheck" class="" id="form-check" accept-charset="UTF-8">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="check"
                                           type="text"
                                           icon="fa fa-money"
                                           v-model.trim="formCheck.check.value"
                                           :value="formCheck.check.value"
                                           :help="formCheck.check.help"
                                           :hasError="formCheck.check.hasError"
                                           :errors="formCheck.check.errors"
                                           :attributes="formCheck.check.attributes"
                                           :label="formCheck.check.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="pay_to"
                                           icon="fa fa-user"
                                           v-model.trim="formCheck.pay_to.value"
                                           :value="formCheck.pay_to.value"
                                           :help="formCheck.pay_to.help"
                                           :hasError="formCheck.pay_to.hasError"
                                           :errors="formCheck.pay_to.errors"
                                           :attributes="formCheck.pay_to.attributes"
                                           :label="formCheck.pay_to.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="formCheck.status.label"
                                             v-model="formCheck.status.value"
                                             :value="formCheck.status.value"
                                             :attributes="formCheck.status.attributes"
                                             :options="formCheck.status.options"
                                             name="status">
                                </vue-select2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="delivered_at"
                                           icon="fa fa-calendar"
                                           v-model.trim="formCheck.delivered_at.value"
                                           :value="formCheck.delivered_at.value"
                                           :help="formCheck.delivered_at.help"
                                           :hasError="formCheck.delivered_at.hasError"
                                           :errors="formCheck.delivered_at.errors"
                                           :attributes="formCheck.delivered_at.attributes"
                                           :label="formCheck.delivered_at.label">
                                </vue-input>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn green" type="submit" :value="buttons.send">
                                <button class="btn red" type="reset" v-text="buttons.cancel"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
        </vue-modal>
        <vue-modal id="modal-update" :title="portlet.title">
            <template slot="body">
                <form @submit.prevent="edit" class="" id="form-check-update" accept-charset="UTF-8">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="check_update"
                                           type="text"
                                           icon="fa fa-money"
                                           v-model.trim="formCheck.check.value"
                                           :value="formCheck.check.value"
                                           :help="formCheck.check.help"
                                           :hasError="formCheck.check.hasError"
                                           :errors="formCheck.check.errors"
                                           :attributes="formCheck.check.attributes"
                                           :label="formCheck.check.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="pay_to_update"
                                           icon="fa fa-user"
                                           v-model.trim="formCheck.pay_to.value"
                                           :value="formCheck.pay_to.value"
                                           :help="formCheck.pay_to.help"
                                           :hasError="formCheck.pay_to.hasError"
                                           :errors="formCheck.pay_to.errors"
                                           :attributes="formCheck.pay_to.attributes"
                                           :label="formCheck.pay_to.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="formCheck.status.label"
                                             v-model="formCheck.status.value"
                                             :value="formCheck.status.value"
                                             :attributes="formCheck.status.attributes"
                                             :options="formCheck.status.options"
                                             name="status_update">
                                </vue-select2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="delivered_at_update"
                                           icon="fa fa-calendar"
                                           v-model.trim="formCheck.delivered_at.value"
                                           :value="formCheck.delivered_at.value"
                                           :help="formCheck.delivered_at.help"
                                           :hasError="formCheck.delivered_at.hasError"
                                           :errors="formCheck.delivered_at.errors"
                                           :attributes="formCheck.delivered_at.attributes"
                                           :label="formCheck.delivered_at.label">
                                </vue-input>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn green" type="submit" :value="buttons.send">
                                <button class="btn red" type="reset" v-text="buttons.cancel"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
        </vue-modal>
        <vue-modal id="modal-report" title="Reporte">
            <template slot="body">
                <form @submit.prevent="generateReport" method="post" :action="route('financial.money.checks.report')" class="" id="form-report" accept-charset="UTF-8">
                    <div class="form-body">
                        <input type="hidden" name="_token" :value="token.content">
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="report.status.label"
                                             v-model="report.status.value"
                                             :value="report.status.value"
                                             :attributes="report.status.attributes"
                                             :options="report.status.options"
                                             name="status">
                                </vue-select2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="start_date"
                                           icon="fa fa-calendar"
                                           v-model.trim="report.available_from.value"
                                           :value="report.available_from.value"
                                           :help="report.available_from.help"
                                           :hasError="report.available_from.hasError"
                                           :errors="report.available_from.errors"
                                           :attributes="report.available_from.attributes"
                                           :label="report.available_from.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="end_date"
                                           icon="fa fa-calendar"
                                           v-model.trim="report.available_until.value"
                                           :value="report.available_until.value"
                                           :help="report.available_until.help"
                                           :hasError="report.available_until.hasError"
                                           :errors="report.available_until.errors"
                                           :attributes="report.available_until.attributes"
                                           :label="report.available_until.label">
                                </vue-input>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions  margin-top-30">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn green" type="submit" :value="buttons.send">
                                <button class="btn red" data-dismiss="modal" type="reset" @click.prevent="setFormNull" v-text="buttons.cancel"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
        </vue-modal>
        <laravel-audits :metadata="audits"></laravel-audits>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import moment from 'moment-with-locales-es6';
    import {mixinMomentLocale} from "../../../mixins/moment";
    import {mixinHttpStatus} from "../../../mixins";
    import {mixinDataTable} from "../../../mixins/datatable";
    import {mixinTootilps} from "../../../mixins/tooltip";
    import {mixinValidator} from "../../../mixins/validation";
    import {mixinSelect2} from "../../../mixins/select2";
    import {mixinLoading} from "../../../mixins/loadingswal";
    import {mixinDate} from "../../../mixins/datepicker";

    export default {
        name: "check",
        mixins: [mixinMomentLocale, mixinHttpStatus, mixinDataTable, mixinTootilps, mixinValidator, mixinSelect2, mixinLoading, mixinDate],
        data: () => {
            return {
                portlet: {
                    title: Lang.get('financial.check.index.title'),
                    btnText: Lang.get('financial.buttons.add'),
                },
                table: {
                    id: 'datatable-check',
                    columns: [
                        {name: Lang.get('financial.generic.table.id'), class: ''},
                        {name: Lang.get('financial.generic.table.check'), class: ''},
                        {name: Lang.get('financial.generic.table.pay_to'), class: ''},
                        {name: Lang.get('financial.generic.table.status_name'), class: ''},
                        {name: Lang.get('financial.generic.table.delivered_at'), class: ''},
                        {name: Lang.get('financial.generic.table.created_at'), class: 'none'},
                        {name: Lang.get('financial.generic.table.actions'), class: ''},
                    ],
                    url: route('financial.api.datatables.checks', {}, false),
                    source: [
                        { data: 'id',           name: 'id' },
                        { data: 'check',        name: 'check',
                            render: function ( data, type, row ) {
                                return data ? data.wordWrap(40,  "<br/>", true) : null;
                            }
                        },
                        { data: 'pay_to',       name: 'pay_to',
                            render: function ( data, type, row ) {
                                return data ? data.wordWrap(40,  "<br/>", true) : null;
                            }
                        },
                        { data: 'status_label', name: 'status_label' },
                        { data: 'delivered_at',   name: 'delivered_at',
                            render: function ( data, type, row ) {
                                return data ? moment(data).format('ll') : null;
                            }
                        },
                        { data: 'created_at',   name: 'created_at',
                            render: function ( data, type, row ) {
                                return data ? moment(data).format('ll') : null;
                            }
                        },
                        { data: 'actions',      name: 'actions', searchable: false, orderable: false },
                    ],
                },
                formCheck: {
                    check: {
                        value: null,
                        help: Lang.get('financial.help-text.check'),
                        label: Lang.get('validation.attributes.check').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            maxlength: 20,
                            minlength: 2,
                            pattern: '[0-9a-záéíóúüñA-ZÁÉÍÓÚÜÑ ]{2,20}',
                        }
                    },
                    pay_to: {
                        value: null,
                        help: Lang.get('financial.help-text.pay_to'),
                        label: Lang.get('validation.attributes.pay_to').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            maxlength: 60,
                            minlength: 2,
                            pattern: '[0-9a-záéíóúüñA-ZÁÉÍÓÚÜÑ ]{2,60}',
                        }
                    },
                    status: {
                        value: null,
                        label: Lang.get('validation.attributes.status').capitalize(),
                        options: [
                            { id: 1, text: Lang.get('validation.attributes.undelivered').capitalize() },
                            { id: 2, text: Lang.get('validation.attributes.delivered').capitalize() },
                        ],
                        attributes: {
                            required: true,
                            disabled: false,
                        }
                    },
                    delivered_at: {
                        value: null,
                        help: Lang.get('financial.help-text.delivered_at'),
                        label: Lang.get('validation.attributes.delivered_at').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: false,
                            autocomplete: 'off',
                            class: 'date date-picker',
                            readonly: true,
                            maxlength: 10,
                            minlength: 10,
                            pattern: '\\d{4}-\\d{2}-\\d{2}',
                        }
                    }
                },
                buttons: {
                    send: Lang.get('financial.buttons.send'),
                    cancel: Lang.get('financial.buttons.cancel'),
                },
                id: 0,
                report: {
                    status: {
                        value: null,
                        label: Lang.get('validation.attributes.status').capitalize(),
                        options: [
                            { id: 1, text: Lang.get('validation.attributes.undelivered').capitalize() },
                            { id: 2, text: Lang.get('validation.attributes.delivered').capitalize() },
                        ],
                        attributes: {
                            required: false,
                            disabled: false,
                        }
                    },
                    available_from: {
                        value: null,
                        help: Lang.get('financial.help-text.valid_until'),
                        label: Lang.get('validation.attributes.start_date').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            // class: 'date date-picker',
                            readonly: true,
                            maxlength: 10,
                            minlength: 10,
                            pattern: '\\d{4}-\\d{2}-\\d{2}',
                        }
                    },
                    available_until: {
                        value: null,
                        help: Lang.get('financial.help-text.valid_from'),
                        label: Lang.get('validation.attributes.end_date').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            // class: 'date date-picker',
                            readonly: true,
                            maxlength: 10,
                            minlength: 10,
                            pattern: '\\d{4}-\\d{2}-\\d{2}',
                        }
                    },
                },
                token: document.head.querySelector('meta[name="csrf-token"]'),
                audits: []
            }
        },
        mounted: function() {
            this.initDatatable();
            this.initFormValidation();
            this.handleDatePicker();
        },
        methods: {
            initDatatable: function () {
                let self = this;
                let table = $( '#datatable-check' ).DataTable({
                    columns: self.table.source,
                    ajax: {
                        url: self.table.url,
                        error: function (data) {
                            self.triggerSwal(data);
                        },
                        fail: function (data) {
                            self.triggerSwal(data);
                        }
                    },
                });

                this.editCheck( table );
                this.deleteCheck( table );
                this.controlLog( table );
            },
            initFormValidation: function() {
                let that = this;
                $('#form-check').validate({
                    rules: {
                        delivered_at: {
                            required: function( element ) { return ( that.formCheck.status.value === '2') },
                            date: true
                        }
                    }
                });
                $('#form-check-update').validate({
                    rules: {
                        delivered_at_update: {
                            required: function( element ) { return ( that.formCheck.status.value === '2') },
                            date: true
                        }
                    }
                });
                $('#form-report').validate();
            },
            handleDatePicker: function() {
                let that = this;
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        format: 'yyyy-mm-dd',
                    }).on('changeDate', function () {
                        that.formCheck.delivered_at.value = this.value;
                    });
                    let start = $('#start_date');
                    let end = $('#end_date');
                    $.extend($.fn.datepicker.defaults, {
                        rtl: App.isRTL(),
                        language: Lang.get('javascript.locale'),
                        orientation: "left",
                        autoclose: true,
                        firstDay: 1,
                        showMonthAfterYear: false,
                        todayBtn: true,
                        todayHighlight: true,
                        calendarWeeks: true,
                        daysOfWeekDisabled: [0],
                        clearBtn: true,
                        startDate: null,
                    });
                    start.datepicker({
                        format: 'yyyy-mm-dd',
                    }).on('changeDate', function () {
                        end.datepicker("setStartDate", moment( this.value ).add( 1, 'days').format('YYYY-MM-DD') );
                        that.report.available_from.value = this.value;
                    });
                    end.datepicker({
                        format: 'yyyy-mm-dd',
                    }).on('changeDate', function () {
                        start.datepicker("setEndDate", moment( this.value ).subtract( 1, 'days').format('YYYY-MM-DD') );
                        that.report.available_until.value = this.value;
                    });
                }
            },
            createCheck: function () {
                if ( $('#form-check').valid() ) {
                    $('#modal-check').modal('hide');
                    this.vueLoading();
                    let data = {
                        check: this.formCheck.check.value,
                        pay_to: this.formCheck.pay_to.value,
                        status: this.formCheck.status.value,
                        delivered_at: this.formCheck.delivered_at.value,
                    };
                    axios.post( route('financial.money.checks.store'), qs.stringify( data ) )
                        .then( (response) => {
                            swal.close();
                            this.triggerSwal( response );
                        })
                        .then(() => {
                            this.setFormNull();
                        })
                        .then(() => {
                            $('.t-refresh').trigger('click');
                        })
                        .catch((error) => {
                            swal.close();
                            this.triggerSwal( error );
                        })
                }
            },
            editCheck: function ( table ) {
                let that = this;
                let $modal = $('#modal-update');
                table.on('click', '.edit', function () {
                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    that.id = data.id;
                    that.formCheck.check.value  = data.check;
                    that.formCheck.pay_to.value = data.pay_to;
                    that.formCheck.status.value = data.status;
                    that.formCheck.delivered_at.value = data.delivered_at;
                    $modal.modal('show');
                });
            },
            controlLog: function ( table ) {
                this.setFormNull();
                let that = this;
                table.on('click', '.log', function () {
                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    that.audits = data.is_dirty.data;
                    $('#modal-log').modal('show');
                });
            },
            edit: function () {
                let $modal = $('#modal-update');
                if ( $('#form-check-update').valid() ) {
                    $modal.modal('hide');
                    this.vueLoading();
                    let put = {
                        check: this.formCheck.check.value,
                        pay_to: this.formCheck.pay_to.value,
                        status: this.formCheck.status.value,
                        delivered_at: this.formCheck.delivered_at.value,
                    };
                    axios.put( route('financial.money.checks.update', { id: this.id }), put )
                        .then( (response) => {
                            swal.close();
                            this.triggerSwal( response );
                        })
                        .then(() => {
                            this.setFormNull();
                        })
                        .then(() => {
                            $('.t-refresh').trigger('click');
                        })
                        .catch((error) => {
                            swal.close();
                            this.triggerSwal( error );
                        })
                }
            },
            setFormNull: function () {
                this.formCheck.check.value = null;
                this.formCheck.pay_to.value = null;
                this.formCheck.status.value = null;
            },
            deleteCheck: function ( table ) {
                let self = this;
                table.on('click', '.trash', function (e) {
                    e.preventDefault();
                    let $tr = $(this).closest('tr');
                    let $url = route( 'financial.money.checks.destroy' , { id: $(this).data('id') } );
                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    let text = '';
                    let to = '';

                    if (data.hasOwnProperty('check') && data.hasOwnProperty('pay_to') ) {
                        text = data.check;
                        to = data.pay_to;
                    }

                    swal({
                        title: Lang.get('javascript.remove'),
                        html: Lang.get('javascript.ask_if_delete') + '<br>' + text + '<br>' + to,
                        type: "question",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger ladda-button",
                        confirmButtonText: Lang.get('financial.buttons.yes'),
                        cancelButtonText: Lang.get('financial.buttons.cancel'),
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function () {
                            return new Promise(function (resolve, reject) {
                                axios.delete( $url, {} )
                                    .then(function(response) {
                                        resolve();
                                    })
                                    .catch(function (error) {
                                        self.triggerSwal( error );
                                    });
                            });
                        },
                    }).then( (result) => {
                        if ( result.value ) {
                            table.ajax.reload(self.handleTooltips(), false);
                            swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
                        }
                    }).catch(swal.noop);
                });
            },
            generateReport: function () {
                let that = this;
                if ( $('#form-report').valid() ) {
                    $('#form-report').submit();
                    let data = {
                        status: that.report.status.value || null,
                        start_date: that.report.available_from.value,
                        end_date: that.report.available_until.value
                    };
                }
            }
        }
    }
</script>

<style scoped>

</style>