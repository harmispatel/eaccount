@extends('layouts.app')


{{--Important Variable--}}

<?php


$moduleName = "Project approval";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-project-diagram";
$breadcrumbCurrentIcon = "archive";
 
$ModelName = 'App\Project_approval';
$ParentRouteName = 'project_approval';


$all = config('role_manage.Project_approval.All');
$create = config('role_manage.Project_approval.Create');
$delete = config('role_manage.Project_approval.Delete');
$edit = config('role_manage.Project_approval.Edit');
$pdf = config('role_manage.Project_approval.Pdf');
$permanently_delete = config('role_manage.Project_approval.PermanentlyDelete');
$restore = config('role_manage.Project_approval.Restore');
$show = config('role_manage.Project_approval.Show');
$trash_show = config('role_manage.Project_approval.TrashShow');

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
            <div class="block-header pjct-ttl">
                @if(!empty($project))
                {{ $project->projectName ? $project->projectName : ''  }}
                @endif
            </div>
            

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                @if(!empty($project))
                    <li><a href="{{ url('/project') }}"><i class="fas fa-project-diagram"></i>{{ $project->projectName ? $project->projectName : ''  }}</a></li>
                    @endif
                <li><a href="{{ route($ParentRouteName) }}"><i
                                class="{{ $breadcrumbMainIcon  }}"></i>{{ $breadcrumbMainName  }}</a></li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon }}</i>{{ $breadcrumbCurrentName }}</li>
            </ol>

            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <a class="btn btn-xs btn-info waves-effect"
                               href="{{ route($ParentRouteName)  }}">All({{ $ModelName::all()->count() }})</a>
                            
                            <a @if ( $trash_show==0)
                               class="dis-none"
                               @endif
                                class="btn btn-xs btn-danger"
                               href="{{ route($ParentRouteName.'.trashed') }}">Trash({{ $ModelName::onlyTrashed()->count()  }}
                                )</a>

                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName.'.active.search') }}"
                                      method="get">
                                    {{ csrf_field() }}
                                    <input type="search" name="search" class="form-control input-sm "
                                           placeholder="Search"/>
                                </form>
                            </ul>
                        </div>
                        <form class="actionForm" action="{{ route($ParentRouteName.'.active.action') }}"
                              method="get">

                            <div class="row body project-approve">                  
                                <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="select_cat" id="select_cat">
                                                <option value="" class="font-custom-bold">Select Category</option>
                                                <option value="all">All</option>
                                                <option value="requisiting">Payment Requisiting</option>
                                                <option value="voucher">Payment Voucher</option>
                                                <option value="settlement">Payment Settlement</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2" style="float: right;">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="select_cat" id="select_cat">
                                                <option value="" class="font-custom-bold">Select Type</option>
                                                <option value="all">All</option>
                                                <option value="incoming">Incoming</option>
                                                <option value="outgoing">Outgoing</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class=" margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
                                    <div class="custom-paginate pull-right">
                                        {{ $projects->links() }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="body table-responsive">
                                {{ csrf_field() }}
                                @if(count($projects)>0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Request User</th>                                      
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $i = 1; ?>
                                            @foreach($projects as $project)
                                                @php
                                                    $supportDonor = $project->hasOneSupportDonor ? $project->hasOneSupportDonor : [];
                                                    $user = $project->hasOneUser ? $project->hasOneUser : [];
                                                @endphp
                                                <tr>
                                                    <?php 
                                                    $getdonor = isset($project->hasManyProjecttodonor) ? $project->hasManyProjecttodonor : []; 
                                                    $donor = [];
                                                    if(count($getdonor)){
                                                        foreach($getdonor as $key => $getdonorone){
                                                            isset($getdonorone->hasOneSupportDonor->supportDonor) ? array_push($donor,$getdonorone->hasOneSupportDonor->supportDonor) : '';
                                                        }
                                                    }
                                                    ?>
                                                    <td class="w-csm-40">{{$project->projectName ? $project->projectName : '' }}</td>
                                                    <td>Project</td>
                                                    <td>{{ isset($project->hasOneUserApplied->name) ? $project->hasOneUserApplied->name : '' }}</td>
                                                    <td>{{ date('Y-m-d',strtotime($project->created_at)) }} </td>
                                                    <td>
                                                        @if (!empty($tasks))
                                                            @php
                                                                $taskStatus = $tasks->hasManyTasksStatus ? $tasks->hasManyTasksStatus : [];
                                                            @endphp
                                                            @foreach ($taskStatus as $taskStatu)
                                                                @php
                                                                    $status = $taskStatu->hasOneStatus ? $taskStatu->hasOneStatus : [];
                                                                @endphp
                                                                @if($project->status == $status->id)
                                                                <span class="label" style="background-color: {{$status->color_code ? $status->color_code : ''}}">{{$status->name ? $status->name : ''}}</span>
                                                                @endif  
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    
                                                    <td class="tdTrashAction w-csm-10">
                                                        <a class="btn btn-xs btn-info waves-effect"
                                                        href="{{ route('project.update_status',['id'=>encrypt($project->id),'status'=>'9']) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Approve"><i class="material-icons">check_circle_outline</i></a>
                                                      
                                                        <a class="btn btn-xs btn-danger waves-effect"
                                                        href="{{ route('project.update_status',['id'=>encrypt($project->id),'status'=>'8']) }}" data-toggle="tooltip" data-placement="top" title="Reject"><i class="material-icons" style="color:#fff">cancel</i></a>


                                                    </td>
                                                </tr>
                                            <?php $i++; ?>
                                            @endforeach

                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Request User</th>                                    
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>
                                @else
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th class="text-center text-danger">There has No data</th>
                                        </tr>
                                        </thead>
                                    </table>
                                @endif
                            </div>

                            <div class="row body">
                                <div class=" margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
                                    <div class="custom-paginate pull-right">
                                        {{ $projects->links() }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!-- #END# Hover Rows -->
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



