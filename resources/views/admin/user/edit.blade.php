@extends('layouts.app')

{{--Important Variables--}}

<?php
$moduleName = " User";
$createItemName = "Edit" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-user";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\User';
$ParentRouteName = 'user';

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
                                      action="{{ route($ParentRouteName.'.update',['id'=>$item->id]) }}"  enctype="multipart/form-data">

                                    {{ csrf_field() }}
                                    <div class="row clearfix">

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input value="{{ $item->name  }}" name="name" type="text"
                                                           class="form-control" >
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input readonly value="{{ $item->email }}" name="email" type="email"
                                                           class="form-control" required>
                                                    <label class="form-label">Email Address</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="password" type="password" class="form-control ">
                                                    <label class="form-label">Password</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="confirm_password" type="password" class="form-control">
                                                    <label class="form-label">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick search-choice" name="role_manage_id"
                                                            id="role_manage_id">
                                                        <option value="0" >Select User Role</option>
                                                        @foreach(App\RoleManage::all() as $role)
                                                            <option @if ($item->role_manage_id==$role->id)
                                                                    selected
                                                                    @endif value="{{$role->id}}"> {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="sikika_field">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select data-live-search="true" class="form-control show-tick search-choice" name="department_id"
                                                                id="department_id">
                                                            <option value="0" >Select User Department</option>
                                                            @foreach(App\Department::all() as $department)
                                                                <option @if ($item->department_id ==$department->id)
                                                                        selected
                                                                        @endif value="{{$department->id}}"> {{ $department->departmentName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select data-live-search="true" class="form-control show-tick search-choice" name="position_id"
                                                                id="department_id">
                                                            <option value="0" >Select User Position</option>
                                                            @foreach(App\Orgenizationleader::all() as $Orgenizationleaderone)
                                                                <option @if ($item->position_id ==$Orgenizationleaderone->id)
                                                                        selected
                                                                        @endif value="{{$Orgenizationleaderone->id}}"> {{ $Orgenizationleaderone->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float" style="margin-top:10px">
                                                    <input type="checkbox" id="department_head" name="department_head" class="filled-in" @if($item->profile->department_head == "1") checked="checked" @endif>
                                                    <label for="department_head">Is Head of Department</label>
                                                </div>
                                            </div>
                                        </div>

                                        <?php //echo '<pre>'; print_r($item->profile); die; ?>

                                        <div id="vendor_field">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="company_name" type="text" value="{{ $item->profile->company_name }}" class="form-control">
                                                        <label class="form-label">Company Name</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="business_registration_no" type="text" class="form-control" value="{{ $item->profile->business_registration_no }}">
                                                        <label class="form-label">Business registration no</label>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="business_license" type="text" class="form-control" value="{{ $item->profile->business_license }}">
                                                        <label class="form-label">Business License</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="bank_details" type="text" class="form-control" value="{{ $item->profile->bank_details }}">
                                                        <label class="form-label">Bank details</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="tra_certification" type="text" class="form-control" value="{{ $item->profile->tra_certification }}">
                                                        <label class="form-label">TRA Certification</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="tin_number" type="text" class="form-control" value="{{ $item->profile->tin_number }}">
                                                        <label class="form-label">TIN Number</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="vat_number" type="text" class="form-control" value="{{ $item->profile->vat_number }}">
                                                        <label class="form-label">VAT Number</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line focused" style="display:flex;">
                                                        <input name="company_logo" type="file" class="form-control">
                                                        <label class="form-label">Company Logo</label>
                                                        @if($item->profile->company_logo != "")<img height="50px" src="{{ url('/').'/'.$item->profile->company_logo }}" />@endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line focused" style="display:flex;">
                                                        <input name="legal_documents" type="file" class="form-control">
                                                        <label class="form-label">Legal documents</label>
                                                        @if($item->profile->legal_documents != "")<img height="50px" src="{{ url('/').'/'.$item->profile->legal_documents }}" />@endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                <div class="form-group form-float" style="margin-top:10px">
                                                    <input type="checkbox" id="physical_verified" name="physical_verified" class="filled-in" @if($item->profile->physical_verified == "1") checked="checked" @endif>
                                                    <label for="physical_verified">Physical verification</label>
                                                </div>
                                            </div>

                                        </div>
                                        
                                        <input value="" name="submitType" id="submitType" type="hidden" value="">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="button" onclick="changeSubmitType('save')" class="btn btn-primary m-t-15 waves-effect">
                                                    Update
                                                </button>
                                                <button type="button" onclick="changeSubmitType('saveAndNew')" class="btn btn-primary m-t-15 waves-effect">
                                                    Update & New
                                                </button>
                                                
                                                <button type="button" onclick="changeSubmitType('saveAndClose')" class="btn btn-primary m-t-15 waves-effect">
                                                    Update & Close
                                                </button>
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

        $(window).on('load', function() {
            $('#vendor_field').hide();
            $('#sikika_field').hide();
            
            if($('#role_manage_id').val() == '2') {
                $('#vendor_field').show();
                $('#sikika_field').hide(); 
            } else if($('#role_manage_id').val() == '3') {
                $('#sikika_field').show(); 
                $('#vendor_field').hide(); 
            }else{
                $('#sikika_field').hide();
                $('#vendor_field').hide();
            } 
        });
        $(function() {
            $('#role_manage_id').change(function(){
                if($('#role_manage_id').val() == '2') {
                    $('#vendor_field').show(); 
                    $('#sikika_field').hide();
                } else if($('#role_manage_id').val() == '3') {
                    $('#sikika_field').show();  
                    $('#vendor_field').hide(); 
                } else{
                    $('#sikika_field').hide(); 
                    $('#vendor_field').hide(); 
                } 
            });
        });

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
                department_id: 'department_id',
                position_id: 'position_id',
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
                        getDepartment_id: document.getElementById(DOMString.department_id),
                        getPosition_id: document.getElementById(DOMString.position_id),
                    }
                },
                getInputsValue: function () {
                    var Fields = this.getFields();
                    return {
                        name: Fields.get_name.value == "" ? 0 : Fields.get_name.value,
                        password: Fields.get_password.value,
                        confirm_password: Fields.get_confirm_password.value,
                        role_manage_id: Fields.getRole_manage_id.value == "" ? 0 : Fields.getRole_manage_id.value,
                        department_id: Fields.getDepartment_id.value == "" ? 0 : Fields.getDepartment_id.value,
                        position_id: Fields.getPosition_id.value == "" ? 0 : Fields.getPosition_id.value,
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
