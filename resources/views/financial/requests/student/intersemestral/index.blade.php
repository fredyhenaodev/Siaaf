@extends('material.layouts.dashboard')

@push('styles')
    <!-- Bootstrap Modal Extended Style -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css" />
    <!-- Loading Styles -->
    <link href="{{ mix('assets/pages/scripts/financial/loading.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', trans('financial.intersemestral.title'))

@section('page-title', trans('financial.intersemestral.index.title'))

@section('page-description', trans('financial.intersemestral.index.description'))

@section('content')
    <div class="col-md-12" id="app">
        <student-intersemestral-request-index></student-intersemestral-request-index>
    </div>
@endsection

@push('plugins')
    <!-- Bootstrap Modal Extended Scripts  -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
    <!-- Loading Scripts -->
    <script src="{{ mix('assets/pages/scripts/financial/loading.min.js') }}" type="text/javascript"></script>
    <!-- Max Length Scripts -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <!-- Validation Scripts -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_'.config('app.locale').'.js') }}" type="text/javascript"></script>
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@endpush