@extends('layouts.app')

{{--Important Variables--}}

<?php

$moduleName = " Activity";
$createItemName = "Edit" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-chart-line";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Activity';
$ParentRouteName = 'activity';
$projectId = Request::get('projectId');

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
                                                    <select data-live-search="true" class="form-control show-tick search-choice" name="project_id"
                                                            id="project_id" onchange="getactivitybasedondepartment()">
                                                        <option value="0" class="font-custom-bold">Select Project</option>
                                                        @foreach(App\Projects::where('status',8)->get() as $project)
                                                            <option @if ($item->project_id==$project->id)
                                                                    selected
                                                                    @endif value="{{$project->id}}"> {{ $project->projectName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick search-choice" name="department_id"
                                                            id="department_id" onchange="getactivitybasedondepartment()">
                                                        <option value="0" class="font-custom-bold">Responsible Department</option>
                                                        @foreach(App\Department::all() as $department)
                                                            <option @if ($item->department_id==$department->id)
                                                                    selected
                                                                    @endif value="{{$department->id}}"> {{ $department->departmentName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick" name="parent_id" id="parent_id">
                                                        {!! createActivitySelectBox($activitys,$item->parent_id) !!}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <input autofocus value="{{ $item->title  }}" name="title" type="text"
                                                           class="form-control">
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input autofocus value="{{ $item->activity_code  }}" name="activity_code" type="text"
                                                           class="form-control" required aria-required="true">
                                                    <label class="form-label">Activity Code</label> 
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

                                        <?php 
                                            $people = [];
                                            if(count($item->hasManyActivitytoquarter)>0){
                                                foreach($item->hasManyActivitytoquarter as $key => $one){
                                                    array_push($people,$one->quarter_id);
                                                }
                                            }
                                        //echo '<pre>'; print_r($item->hasManyActivitytoquarter[0]->quarter_id); die; 
                                        
                                        ?>
                                        

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" multiple class="form-control show-tick search-choice" name="quarter[]"
                                                            id="quarter">
                                                            <option @if (in_array("1",$people )) selected @endif value="1">Quarter 1</option>
                                                            <option @if (in_array("2",$people )) selected @endif value="2">Quarter 2</option>
                                                            <option @if (in_array("3",$people )) selected @endif value="3">Quarter 3</option>
                                                            <option @if (in_array("4",$people )) selected @endif value="4">Quarter 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <input value="" name="submitType" id="submitType" type="hidden" value="">
                                        <input name="selectedProjectId" id="selectedProjectId" type="hidden" value="{{$projectId}}">

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
        function changeSubmitType(submitType){
            jQuery("#submitType").val(submitType);
            $("#form_validation").submit();
        }
        function getactivitybasedondepartment(){
            var department_id = jQuery("#department_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('activity.get_activity_to_department') }}",
                data: {'department_id':department_id,'projectId':jQuery("#project_id").val()},     
                success: function (data) {
                    $('#parent_id').html(data.result);
                    $('#parent_id').selectpicker('refresh');           
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
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




        // Validation and calculation
        var UiController = (function () {

            var DOMString = {
                submit_form: 'form.form',
                name: 'input[name=name]',
                password: 'input[name=password]',
                confirm_password: 'input[name=confirm_password]',
                role_manage_id: 'role_manage_id',
                project_id: 'project_id',
                department_id: 'department_id',
                quarter: 'quarter',
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
                        getProject_id: document.getElementById(DOMString.project_id),
                        getDepartment_id: document.getElementById(DOMString.department_id),
                        getQuarter: document.getElementById(DOMString.quarter),


                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        password: Fields.get_password.value,
                        confirm_password: Fields.get_confirm_password.value,
                        role_manage_id: Fields.getRole_manage_id.value == "" ? 0 : Fields.getRole_manage_id.value,
                        project_id: Fields.getProject_id.value == "" ? 0 : Fields.getProject_id.value,
                        department_id: Fields.getDepartment_id.value == "" ? 0 : Fields.getDepartment_id.value,
                        quarter: Fields.getQuarter.value == "" ? 0 : Fields.getQuarter.value,

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
