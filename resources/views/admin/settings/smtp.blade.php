@extends('layouts.app')


{{--Important Variable--}}

<?php
$moduleName = "SMTP";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-envelope-open-text";
$breadcrumbCurrentIcon = "archive";

$createItemNamesmtp = "SMTP SETTING";


$ParentRouteNamesmtp = 'settings.smtp';

?>


@section('title')
    {{ $moduleName }} -> {{ $breadcrumbCurrentName }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')

    <section class="content">
        <div class="container-fluid">
          
            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteNamesmtp) }}"><i class="{{ $breadcrumbMainIcon  }}"></i>{{ $breadcrumbMainName  }}</a></li>
                <li class="active"><i class="material-icons">{{ $breadcrumbCurrentIcon }}</i>{{ $breadcrumbCurrentName }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li><a href="{{ route('emailTemplate') }}">Email</a></li>
                            <li class="active"><a href="{{ route('settings.smtp') }}">SMTP</a></li>
                        </ul>
                    <div class="tab-content">
                         
                        <!-- SMTP Setting start -->

                        <div class="tab-pane active">
                            <div class="header">
                                <h2>
                                    {{ $createItemNamesmtp  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNamesmtp.'.update') }}">

                                        {{ csrf_field() }}
                                        <div class="row clearfix">
                                            <?php //echo '<pre>'; print_r($settings); die; ?>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ isset($settings['MAIL_DRIVER']) ? $settings['MAIL_DRIVER'] : '' }}" name="mail_driver" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL DRIVER</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ isset($settings['MAIL_HOST']) ? $settings['MAIL_HOST'] : '' }}" name="mail_host" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL HOST</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ isset($settings['MAIL_PORT']) ? $settings['MAIL_PORT'] : '' }}"  name="mail_port" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL PORT</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ isset($settings['MAIL_USERNAME']) ? $settings['MAIL_USERNAME'] : '' }}"  name="mail_username" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL USERNAME</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ isset($settings['MAIL_PASSWORD']) ? $settings['MAIL_PASSWORD'] : '' }}"  name="mail_password" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL PASSWORD</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">MAIL ENCRYPTION</label>
                                                        <select data-live-search="true" class="form-control show-tick" name="mail_encryption">
                                                            <option value="tls" @if((isset($settings['MAIL_ENCRYPTION'])) && ($settings['MAIL_ENCRYPTION'] == "tls")) selected @endif>TLS</option>
                                                            <option value="ssl" @if((isset($settings['MAIL_ENCRYPTION'])) && ($settings['MAIL_ENCRYPTION'] == "ssl")) selected @endif>SSL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- SMTP Setting End -->
                    </div>
                    </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
                </div>

            </div>
        </div>
    </section>

@stop

@push('include-css')
    <!-- Wait Me Css -->
    <link href="{{ asset('asset/plugins/waitme/waitMe.css') }}" rel="stylesheet"/>

    <!-- Colorpicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet"/>

    <!-- Dropzone Css -->
    <link href="{{ asset('asset/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('asset/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('asset/plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('asset/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>


@endpush

@push('include-js')

    {{--<script src="{{ asset('asset/js/pages/ui/modals.js') }}"></script>--}}
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>
    <!-- Autosize Plugin Js -->


    <script>
        @if(Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif

                @if(Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif

                @if ($errors->any())
                @foreach ($errors->all() as $error)
            toastr["error"]('{{ $error }}');
        @endforeach
        @endif

    </script>

    {{--All datagrid --}}
    <script src="{{ asset('asset/js/dataTable.js')  }}"></script>
    <script>
        BaseController.init();
    </script>
@endpush



