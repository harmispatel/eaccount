@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Cost_item";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-money-bill";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Cost_item';
$ParentRouteName = 'cost_item';

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
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">Back</a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i> Home</a></li>
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
                                <small>Edit {{ $moduleName  }} Information</small>
                            </h2>

                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                      action="{{ route($ParentRouteName.'.update',['id'=>$item->id]) }}">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                            name="main_activity_id"
                                                            id="main_activity_id" onchange="getSubActivity()">
                                                        <option value="0">Select Activity</option>
                                                        @foreach($activitys as $activity)
                                                        <?php
                                                            if ($activity->parent_id == 0) { 
                                                        ?>
                                                            <option @if($item->main_activity_id == $activity->id) {{ "selected" }} @endif value="{{ $activity->id }}">{{ $activity->title }}</option>
                                                        <?php
                                                            } 
                                                        ?>
                                                        
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
                                                        <option value="0">Select Sub Activity</option>
                                                        @foreach($activitys as $activity)
                                                        <?php
                                                            if ($activity->parent_id != 0) { 
                                                        ?>
                                                            <option @if($item->sub_activity_id == $activity->id) {{ "selected" }} @endif value="{{ $activity->id }}">{{ $activity->title }}</option>
                                                        <?php
                                                            } 
                                                        ?>
                                                        
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    {{-- <label for="cars">Choose a car:</label> --}}
                                                    <input autofocus value="{{ $item->title  }}" name="title" type="text"
                                                           class="form-control" required aria-required="true">
                                                    <label class="form-label">Title</label> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ $item->description  }}" name="description" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Description</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ $item->unit  }}" name="unit" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Unit</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ $item->cost  }}" name="cost" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Cost</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ $item->frequency  }}" name="frequency" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Frequency</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick" name="status" id="status">
                                                    <option @if($item->status == "0") {{ "selected" }} @endif value="0">Select Status</option>
                                                    <option @if($item->status == "1") {{ "selected" }} @endif value="1">Pending</option>
                                                    <option @if($item->status == "2") {{ "selected" }} @endif value="2">Approval Stage</option>
                                                    <option @if($item->status == "3") {{ "selected" }} @endif value="3">On Progress</option>
                                                    <option @if($item->status == "4") {{ "selected" }} @endif value="4">Wait Clearance</option>
                                                    <option @if($item->status == "5") {{ "selected" }} @endif value="5">Half Cleared</option>
                                                    <option @if($item->status == "6") {{ "selected" }} @endif value="6">Completed</option>
                                                
                                                </select>
                                            </div>
                                        </div>

                                        <input value="" name="submitType" id="submitType" type="hidden" value="">
                                         

                                        {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick" name="status" id="status">
                                                    <option value="0">Select Status</option>
                                                    <option @if($item->status == "1") {{ "selected" }} @endif value="1">Started</option>
                                                    <option @if($item->status == "2") {{ "selected" }} @endif value="2">In Progress</option>
                                                    <option @if($item->status == "3") {{ "selected" }} @endif value="3">Cancel</option>
                                                    <option @if($item->status == "4") {{ "selected" }} @endif value="4">On Hold</option>
                                                    <option @if($item->status == "5") {{ "selected" }} @endif value="5">Completed</option>
                                                
                                                </select>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick" name="status" id="status">
                                                    <option value="0">Select Status</option>
                                                    <option @if($item->status == "1") {{ "selected" }} @endif value="1">Pending</option>
                                                    <option @if($item->status == "2") {{ "selected" }} @endif value="2">Approval Stage</option>
                                                    <option @if($item->status == "3") {{ "selected" }} @endif value="3">On Progress</option>
                                                    <option @if($item->status == "4") {{ "selected" }} @endif value="4">Wait Clearance</option>
                                                    <option @if($item->status == "5") {{ "selected" }} @endif value="5">Half Cleared</option>
                                                    <option @if($item->status == "6") {{ "selected" }} @endif value="6">Completed</option>
                                                
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                {{-- <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Update
                                                </button> --}}
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-line">
                                                        <button type="button" onclick="changeSubmitType('save')" class="btn btn-primary m-t-15 waves-effect">
                                                            Update
                                                        </button>
                                                        <button type="button" onclick="changeSubmitType('saveAndNew')" class="btn btn-primary m-t-15 waves-effect">
                                                            Update & New
                                                        </button>
                                                        <button type="button" onclick="changeSubmitType('saveAndCopy')" class="btn btn-primary m-t-15 waves-effect">
                                                            Update & Copy
                                                        </button>
                                                        <button type="button" onclick="changeSubmitType('saveAndClose')" class="btn btn-primary m-t-15 waves-effect">
                                                            Update & Close
                                                        </button>
                                                    </div>
                                                </div>
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
                password: 'input[name=password]',
                confirm_password: 'input[name=confirm_password]',
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
                        getRole_manage_id: document.getElementById(DOMString.role_manage_id),


                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        password: Fields.get_password.value,
                        confirm_password: Fields.get_confirm_password.value,
                        role_manage_id: Fields.getRole_manage_id.value == "" ? 0 : Fields.getRole_manage_id.value,

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


                if (input_values.name == 0) {
                    toastr["error"]('Set Any' + FieldName1);
                    e.preventDefault();
                }

                if (input_values.password != input_values.confirm_password) {
                    toastr["error"]('Password Does Not Match');
                    e.preventDefault();
                }


                if (input_values.role_manage_id == 0) {
                    toastr["error"]('Select Any Role');
                    e.preventDefault();
                }

            };
            return {
                init: function () {
                    setUpEventListner();

                }
            }

        })(UiController);

        MainController.init();

    </script>

@endpush