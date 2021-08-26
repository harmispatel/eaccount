@extends('layouts.app')

{{--Important Variables--}}

<?php
$moduleName = " Budget_items";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-money-bill";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Cost_item';
$ParentRouteName = 'cost_item';

$projectId = Request::get('projectId');
$activityId = Request::get('activityId');

?>

@section('title')
    {{ $moduleName }}->{{ $createItemName }}
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
            <div class="block-header pull-left">
                <a class="btn btn-sm btn-info  waves-effect" href="{{ url()->previous() }}">Back</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }} "></i>{{  $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> {{ $breadcrumbCurrentName  }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $createItemName  }}
                                <small>Put {{ $moduleName  }} Information</small>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.store') }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="main_activity_id"
                                                            id="main_activity_id" onchange="getSubActivity()">
                                                        <option value="0" class="font-custom-bold">Select Activity</option>
                                                        @foreach($activitys as $activity)
                                                            @if ($activity->parent_id == 0 )
                                                                <option value="{{ $activity->id }}" @if($selectedActivity->parent_id == $activity->id || $selectedActivity->id == $activity->id) selected @endif>{{ $activity->title }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="sub_activity_id"
                                                            id="sub_activity_id">
                                                            @if(!empty($selectedActivity))
                                                                @foreach($activitys as $activity)
                                                                    @if ($activity->parent_id != 0 && ($activity->parent_id == $selectedActivity->parent_id || $activity->parent_id == $selectedActivity->id))
                                                                        <option value="{{ $activity->id }}" @if($activity->id == $selectedActivity->id) selected @endif>{{ $activity->title }}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    {{-- <label for="cars">Choose a car:</label> --}}
                                                    <input autofocus value="{{ old('title')  }}" name="title" type="text"
                                                           class="form-control" required aria-required="true">
                                                    <label class="form-label">Title</label> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ old('description')  }}" name="description" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Memo</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ old('unit')  }}" name="unit" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Unit</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ old('cost')  }}" name="cost" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Cost</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ old('frequency')  }}" name="frequency" type="number"
                                                    class="form-control">
                                                    <label class="form-label">Frequency</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input value="" name="submitType" id="submitType" type="hidden" value="">
                                        <input name="selectedProjectId" id="selectedProjectId" type="hidden" value="{{$projectId}}">
                                        <input name="selectedActivityId" id="selectedActivityId" type="hidden" value="{{$activityId}}">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="button" onclick="changeSubmitType('save')" class="btn-csm-save m-t-15 waves-effect"> <i class="fa fa-edit"></i> Save</button>
                                                <button type="button" onclick="changeSubmitType('saveAndNew')" class="btn-new-style m-t-15 waves-effect"><span><i class="fa fa-plus"></i></span> Save & New</button>
                                                <button type="button" onclick="changeSubmitType('saveAndCopy')" class="btn-new-style m-t-15 waves-effect"><span><i class="fa fa-copy"></i></span> Save & Copy</button>
                                                <button type="button" onclick="changeSubmitType('saveAndClose')" class="btn-new-style m-t-15 waves-effect"><span><i class="far fa-check-circle last_csm_btn"></i></span> Save & Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>
    </section>

@stop

@push('include-css')

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



    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
          rel="stylesheet"/>

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>


    <!-- noUISlider Css -->
    <link href="{{ asset('asset/plugins/nouislider/nouislider.min.css') }}" rel="stylesheet"/>

    <!-- Sweet Alert Css -->
    <link href="{{ asset('asset/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"/>


@endpush

@push('include-js')


    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>


    <!-- Sweet Alert Plugin Js -->
    <script src="{{ asset('asset/plugins/sweetalert/sweetalert.min.js') }}"></script>


    <!-- Autosize Plugin Js -->
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>

    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>


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

    function changeSubmitType(submitType){
        jQuery("#submitType").val(submitType);
        $("#form_validation").submit();
    }
    function getSubActivity(){
        var main_act_id = $('#main_activity_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('cost_item.get_sub_activity') }}",
            data: {'main_act_id':main_act_id},     
            success: function (data) {
                $('#sub_activity_id').html(data.result);
                $('#sub_activity_id').selectpicker('refresh');           
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

        // Validation and calculation
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',
                name: 'input[name=name]',
                email: 'input[name=email]',
                password: 'input[name=password]',
                confirm_password: 'input[name=password_confirmation]',
                role_manage_id: 'role_manage_id',


            };

            return {
                getDOMString: function () {
                    return DOMString;
                },
                getFields: function () {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_name: document.querySelector(DOMString.name),
                        get_password: document.querySelector(DOMString.password),
                        get_confirm_password: document.querySelector(DOMString.confirm_password),
                        get_email: document.querySelector(DOMString.email),
                        get_role_manage_id: document.getElementById(DOMString.role_manage_id),


                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {

                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        email: Fields.get_email.value == "" ? 0 : Fields.get_email.value,
                        password: Fields.get_password.value,
                        confirm_password: Fields.get_confirm_password.value,
                        role_manage_id: Fields.get_role_manage_id.value == "" ? 0 : Fields.get_role_manage_id.value,


                    }
                },

            }
        })();

        var MainController = (function (UICnt) {

            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();

            var setUpEventListner = function () {

                Fields.get_form.addEventListener('submit', validation);

            };

            var validation = function (e) {
                var input_values, Fields;
                input_values = UICnt.getInputsValue();
                Fields = UICnt.getFields();

                var FieldName1 = " Name";


                if (input_values.role_manage_id == 0) {
                    toastr["error"]('Select Any Role');
                    e.preventDefault();
                }


                if (input_values.password != input_values.confirm_password) {
                    toastr["error"]('Password Does Not Match');
                    e.preventDefault();
                }

                if (input_values.email == 0) {
                    toastr["error"]('Email Is Required');
                    e.preventDefault();
                }

                if (input_values.name == 0) {
                    toastr["error"]('Name is Required');
                    e.preventDefault();
                }


            };

            return {
                init: function () {
                    console.log("App Is running");
                    setUpEventListner();

                }
            }

        })(UiController);

        MainController.init();


    </script>

@endpush
