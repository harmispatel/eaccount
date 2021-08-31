@extends('layouts.app')


{{--Important Variable--}}

<?php


$moduleName = " Budget_items";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-money-bill";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Cost_item';
$ParentRouteName = 'cost_item';


$all = config('role_manage.Cost_item.All');
$create = config('role_manage.Cost_item.Create');
$delete = config('role_manage.Cost_item.Delete');
$edit = config('role_manage.Cost_item.Edit');
$pdf = config('role_manage.Cost_item.Pdf');
$permanently_delete = config('role_manage.Cost_item.PermanentlyDelete');
$restore = config('role_manage.Cost_item.Restore');
$show = config('role_manage.Cost_item.Show');
$trash_show = config('role_manage.Cost_item.TrashShow');

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

    <style>
        .block-header.pjct-ttl {font-size: 18px; font-weight: 600; color: #444;} 
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header pjct-ttl">
                @if(!empty($project))
                {{ $project->projectName ? $project->projectName : ''  }} > 
                @endif
                @if(!empty($activity))
                {{ $activity->title ? $activity->title : ''  }}
                @endif
            </div>
            <div class="block-header pull-left">
                <a class="btn btn-sm btn-info waves-effect" href="{{ route("activity",["projectId"=>$projectId]) }}"> Back to activities </a>
                @if($project->status == 8)
                    <a @if ( $create==0 ) class="dis-none" @endif class="btn btn-sm btn-info waves-effect" href="@if(!empty($activity)){{ route($ParentRouteName.'.create',['activityId'=>$activity->id,'projectId'=>$projectId]) }}@else{{ route($ParentRouteName.'.create') }}@endif">Add New </a>
                @endif
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="@if(!empty($activity)){{ route($ParentRouteName,['activityId'=>$activity->id,'projectId'=>$projectId]) }}@else{{ route($ParentRouteName) }}@endif"><i class="{{ $breadcrumbMainIcon  }}"></i>{{$moduleName}}</a></li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon }}</i>{{ $breadcrumbCurrentName }}</li>
            </ol>

            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            
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
                            
                            <div class="row body">
                                <div class=" margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
                                    <div class="custom-paginate pull-right">
                                        {{ $items->links() }}
                                    </div>
                                </div>
                            </div>
                            <div class="body table-responsive">
                                {{ csrf_field() }}
                                <table class="table table-hover table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th class="checkbox_custom_style text-center">
                                            <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                   class="chk-col-cyan"/>
                                            <label for="md_checkbox_p"></label>
                                        </th>

                                        <th>Activity code</th>
                                        <th>Title</th>                                       
                                        <th>Responsible staff</th>                                        
                                        <th>unit</th>
                                        <th>cost</th>
                                        <th>frequency</th>
                                        <th>status</th>                               
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i = 1; ?>
                                        @foreach($items as $item)
                                            <tr @if (Auth::id()==$item->id)

                                                    class="bg-tr"

                                                    @endif >
                                                <th class="text-center">
                                                    <input name="items[id][]" value="{{ $item->id }}"
                                                           type="checkbox" id="md_checkbox_{{ $i }}"
                                                           class="chk-col-cyan selects "/>
                                                    <label for="md_checkbox_{{ $i }}"></label>
                                                </th>
                                                @php
                                                    $activityObj = $item->hasOneSubActivity ? $item->hasOneSubActivity : [];
                                                    $activityObj = empty($activityObj) ? $item->hasOneParentActivity : $activityObj;
                                                    if(!empty($activityObj)){
                                                        $department = $activityObj->hasOneDepartment ? $activityObj->hasOneDepartment : [];
                                                    }   
                                                @endphp
                                                <td>{{ !empty($department) ? $department->department_code : '' }}/{{ !empty($activityObj) ? $activityObj->activity_code : '' }}</td>
                                                <td class="w-csm-40">{{ $item->title }}</td>
                                                <td>{{ !empty($department) ? $department->departmentName : '' }}</td>
                                                <td>{{ $item->unit }}</td>
                                                <td>{{ $item->cost }}</td>
                                                <td>{{ $item->frequency }}</td>
                                                
                                                
                                                <td>
                                                    @if (!empty($tasks))
                                                        @php
                                                            $taskStatus = $tasks->hasManyTasksStatus ? $tasks->hasManyTasksStatus : [];
                                                        @endphp
                                                        @foreach ($taskStatus as $taskStatu)
                                                            @php
                                                                $status = $taskStatu->hasOneStatus ? $taskStatu->hasOneStatus : [];
                                                            @endphp
                                                            @if($item->status == $status->id)
                                                            <span class="label" style="background-color: {{$status->color_code ? $status->color_code : ''}}">{{$status->name ? $status->name : ''}}</span>
                                                            @endif  
                                                        @endforeach     
                                                    @endif
                                                </td>
                                                
                                                <td class="tdTrashAction w-csm-20">
                                                    @if($project->status == 8)
                                                        <a @if ($edit==0) class="dis-none" @endif class="btn btn-xs btn-info waves-effect" href="@if(!empty($activity)){{ route($ParentRouteName.'.edit',['id'=>$item->id,'activityId'=>$activity->id,'projectId'=>$projectId]) }}@else{{ route($ParentRouteName.'.edit',['id'=>$item->id]) }}@endif" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons">mode_edit</i></a>
                                                        <a data-target="#largeModal" class="btn btn-xs btn-success waves-effect ajaxCall hidden" href="{{  route($ParentRouteName.'.show',['id'=>$item->id])  }}" data-toggle="tooltip" data-placement="top" title="Preview"><i class="material-icons">pageview</i></a>
                                                        <a @if ($delete==0) class="dis-none" @endif class="btn btn-xs btn-danger waves-effect" href="@if(!empty($activity)){{ route($ParentRouteName.'.destroy',['id'=>$item->id,'activityId'=>$activity->id,'projectId'=>$projectId]) }}@else{{ route($ParentRouteName.'.destroy',['id'=>$item->id]) }}@endif" data-toggle="tooltip" data-placement="top" title="Trash"> <i class="material-icons">delete</i></a>
                                                        
                                                    @else
                                                        <a @if ($edit==0) class="dis-none" @endif class="btn btn-xs waves-effect" style="background-color:#808080" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" style="color:#fff">mode_edit</i></a>
                                                        <a data-target="#largeModal" class="btn btn-xs btn-success waves-effect ajaxCall hidden" data-toggle="tooltip" data-placement="top" title="Preview"><i class="material-icons">pageview</i></a>
                                                        <span  class="btn btn-xs waves-effect" style="background-color:#808080" ><i class="material-icons"style="color:#fff">delete</i></span>
                                                    @endif
                                                    @if($project->status == 9)
                                                        @if (Auth::user()->department_head == 1)
                                                            <a class="btn btn-xs btn-success waves-effect" href="@if(!empty($activity)){{ route('reallocation.create',['id'=>$item->id,'activityId'=>$activity->id,'projectId'=>$projectId]) }}@else{{ route('reallocation.create',['id'=>$item->id]) }}@endif" data-toggle="tooltip" data-placement="top" title="Reallocation">Reallocation</a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        <?php $i++; ?>
                                        @endforeach

                                    
                                    <thead>
                                    <tr>
                                        <th class="checkbox_custom_style text-center">
                                            <input name="selectBottom" type="checkbox" id="md_checkbox_footer"
                                                   class="chk-col-cyan"/>
                                            <label for="md_checkbox_footer"></label>
                                        </th>

                                        <th>Activity code</th>
                                        <th>Title</th>
                                        <th>Responsible staff</th>                                                                       
                                        <th>unit</th>
                                        <th>cost</th>
                                        <th>frequency</th>
                                        <th>status</th>                               
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    </tbody>
                                </table>
                            </div>

                            <div class="row body">
                                <div class=" margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
                                    <div class="custom-paginate pull-right">
                                        {{ $items->links() }}
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



