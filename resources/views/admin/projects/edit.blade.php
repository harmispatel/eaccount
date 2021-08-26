@extends('layouts.app')

{{--Important Variables--}}

<?php
$moduleName = " Project";
$createItemName = "Edit" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-user";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Projects';
$ParentRouteName = 'project';

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
                                                    <input autofocus value="{{ $item->projectName  }}" name="projectName" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Project Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick" name="region">
                                                        <option value="0" class="font-custom-bold">Select Region</option>
                                                        @if(count($region))
                                                            @foreach ($region as $oneregion)
                                                            <option value="{{$oneregion->id}}" @if($item->region == $oneregion->id) selected @endif >{{$oneregion->name ? $oneregion->name : ''}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php 
                                            $people = [];
                                            if(count($item->hasManyProjecttodonor)>0){
                                                foreach($item->hasManyProjecttodonor as $key => $one){
                                                    array_push($people,$one->donor_id);
                                                }
                                            }
                                        ?>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" multiple class="form-control show-tick" name="donor[]">
                                                        <option value="0" class="font-custom-bold">Select Donor</option>
                                                        @if(count($supportDonors))
                                                            @foreach ($supportDonors as $supportDonor)
                                                            <option value="{{$supportDonor->id}}" @if (in_array($supportDonor->id,$people )) selected @endif >{{$supportDonor->supportDonor ? $supportDonor->supportDonor : ''}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick" name="coordinator">
                                                        <option value="0" class="font-custom-bold">Coordinator</option>
                                                        @if(count($users))
                                                            @foreach ($users as $user)
                                                            <option value="{{$user->id}}" @if($item->coordinator == $user->id) selected @endif>{{$user->name ? $user->name : ''}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ $item->over_budget }}" name="over_budget" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Over Budget (%)</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ $item->total_budget }}" name="total_budget" type="number"
                                                           class="form-control">
                                                    <label class="form-label">Total Budget</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input  name="start_date" value="{{ $item->start_date }}" type="text" id="startdate" class="form-control floating-label">
                                                    <label class="form-label">Start Date</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input  name="end_date" type="text" value="{{ $item->end_date }}" id="enddate" class="form-control floating-label">
                                                    <label class="form-label">End Date</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-line">
                                                <select data-live-search="true" class="form-control show-tick" name="status" id="status">
                                                    <option value="0" class="font-custom-bold">Select Status</option>
                                                    <option @if($item->status == "1") {{ "selected" }} @endif value="1">Started</option>
                                                    <option @if($item->status == "2") {{ "selected" }} @endif value="2">In Progress</option>
                                                    <option @if($item->status == "3") {{ "selected" }} @endif value="3">Cancel</option>
                                                    <option @if($item->status == 4) {{ "selected" }} @endif value="4">On Hold</option>
                                                    <option @if($item->status == "5") {{ "selected" }} @endif value="5">Completed</option>
                                                
                                                </select>
                                            </div>
                                        </div> -->

                                        <input value="" name="submitType" id="submitType" type="hidden" value="">

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

        $('#startdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
        $('#enddate').bootstrapMaterialDatePicker({ weekStart : 0, time: false });

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
