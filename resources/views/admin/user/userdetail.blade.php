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
            <!-- <----------------Start-------------->
            <div class="card">
                <div class="user_main" style="margin-top: 50px;padding: 20px 0px;">
                    <div class="container-fluid">
                
                        <div class="row">
                            <div class="col-md-4">
                                <div class="user_left_detail">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="project_detail">
                                                <p>6</p>
                                                <p>Open Tasks</p>
                                                <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="project_detail">
                                                <p>6</p>
                                                <p>Open Tasks</p>
                                                <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="project_detail">
                                                <p>6</p>
                                                <p>Open Tasks</p>
                                                <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="project_detail">
                                                <p>6</p>
                                                <p>Completed Tasks</p>
                                                <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="user_img">
                                @if($item->profile->avatar != "")
                                    <img src="{{ url('/').'/'.$item->profile->avatar }}">
                                @else
                                    <img class="width-140 height-140" src="{{ asset('upload/avatar/avatar.png') }}">
                                @endif
                                </div>
                                <div class="user_text">
                                    <h2> {{ $item->name ? $item->name : ""  }} </h2>
                                    <p>EMP ID:{{ $item->id ? $item->id : ""  }}</p>
                                </div>
                                <div class="user_last_text">
                                    <h3>{{ isset($item->hasOneDepartment->departmentName) ? $item->hasOneDepartment->departmentName : "" }}</h3>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="user_left_detail">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="project_detail">
                                                <p>6</p>
                                                <p>Open Tasks</p>
                                                <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="project_detail">
                                                <p>6</p>
                                                <p>Open Tasks</p>
                                                <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="project_detail">
                                                <p>6</p>
                                                <p>Open Tasks</p>
                                                <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="project_detail">
                                                <p>6</p>
                                                <p>Completed Tasks</p>
                                                <a href="#">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#basicDetails">Basic Details</a></li>
                    <li><a data-toggle="tab" href="#bankDetails">Bank Details</a></li>
                    <li><a data-toggle="tab" href="#documentDetails">Document Details</a></li>
                    <li><a data-toggle="tab" href="#paymentRequsitions">Payment Requsitions</a></li>
                    <li><a data-toggle="tab" href="#paymentVouchers">Payment Vouchers</a></li>
                    <li><a data-toggle="tab" href="#paymentSettlement">Payment Settlement</a></li>
                    <li><a data-toggle="tab" href="#budgetMoniter">Budget Moniter</a></li>
                    <li><a data-toggle="tab" href="#attchment">Attchment</a></li>
                    <li><a data-toggle="tab" href="#cv">Cv</a></li>
                </ul>

                <div class="tab-content">
                    <div id="basicDetails" class="tab-pane fade in active">
                        <div class="user_info_main">
                            <div class="user_head">
                                <h2>{{ $item->name ? $item->name : ""  }}</h2>
                                <a href="{{ route($ParentRouteName.'.edit',['id'=>$item->id]) }}">Update</a>
                            </div>
                            <div class="user_info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">   
                                            <div class="user_filed">
                                                <table class="table table-style1">
                                                    <tbody>
                                                        <tr>
                                                            <td align="right">EMP ID:</td>
                                                            <td> 4154435</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Name:</td>
                                                            <td> {{ $item->name ? $item->name : "" }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Joining Date:</td>
                                                            <td> {{ $item->created_at ? $item->created_at : "" }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Email:</td>
                                                            <td> {{ $item->email ? $item->email : "" }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Parent Address:</td>
                                                            <td> {{ $item->profile->present_address ? $item->profile->present_address : "" }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="user_filed">
                                                <table class="table table-style1">
                                                    <tbody>
                                                        <tr>
                                                            <td align="right">Full Name:</td>
                                                            <td> {{ $item->profile->first_name ? $item->profile->first_name : ""  }} {{ $item->profile->last_name ? $item->profile->last_name : ""  }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Password:</td>
                                                            <td><a href="{{ route($ParentRouteName.'.edit',['id'=>$item->id]) }}">Change Password</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Gender:</td>
                                                            <td>
                                                                @if($item->profile->gender == 1)
                                                                    Male
                                                                @elseif($item->profile->gender == 2)
                                                                    Female
                                                                @elseif($item->profile->gender == 3)
                                                                    Common
                                                                @elseif($item->profile->gender == 4)
                                                                    Not Willing To Say
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr> 
                                                            <td align="right">Mothers Name:</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">Phone:</td>
                                                            <td> {{ $item->profile->phone_number ? $item->profile->phone_number : "" }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="bankDetails" class="tab-pane fade in">
                        <h2>BankDetails</h2>
                    </div>

                    <div id="documentDetails" class="tab-pane fade in">
                        <h2>documentDetails</h2>
                    </div>

                    <div id="paymentRequsitions" class="tab-pane fade in">
                        <h2>paymentRequsitions</h2>
                    </div>

                    <div id="paymentVouchers" class="tab-pane fade in">
                        <h2>paymentVouchers</h2>
                    </div>

                    <div id="paymentSettlement" class="tab-pane fade in">
                        <h2>paymentSettlement</h2>
                    </div>

                    <div id="budgetMoniter" class="tab-pane fade in">
                        <h2>budgetMoniter</h2>
                    </div>

                    <div id="attchment" class="tab-pane fade in">
                        <h2>attchment</h2>
                    </div>

                    <div id="cv" class="tab-pane fade in">
                        <h2>cv</h2>
                    </div>
                </div>
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
