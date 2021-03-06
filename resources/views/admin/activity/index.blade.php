@extends('layouts.app')


{{--Important Variable--}}

<?php


$moduleName = " Activity";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-chart-line";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Activity';
$ParentRouteName = 'activity';


$all = config('role_manage.Activity.All');
$create = config('role_manage.Activity.Create');
$delete = config('role_manage.Activity.Delete');
$edit = config('role_manage.Activity.Edit');
$pdf = config('role_manage.Activity.Pdf');
$permanently_delete = config('role_manage.Activity.PermanentlyDelete');
$restore = config('role_manage.Activity.Restore');
$show = config('role_manage.Activity.Show');
$trash_show = config('role_manage.Activity.TrashShow');

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
                {{ $project->projectName ? $project->projectName : ''  }}
                @endif
            </div>
            <div class="block-header pull-left">

                <a class="btn btn-sm btn-info waves-effect bck-to-prjct" href="{{ url('project') }}"><i class="fas fa-arrow-left"></i> Back to Projects </a>
                @if($project->status == 8)
                    <a @if ( $create==0 ) class="dis-none" @endif class="btn btn-sm btn-info waves-effect" href="@if(!empty($project)) {{ route($ParentRouteName.'.create',['projectId'=>$project->id]) }}@else{{ route($ParentRouteName.'.create') }}@endif">Add Activity </a> 
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
                        <div class="header" style="padding: 30px;">
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
                                        <th>Activity</th>
                                        <th>Department</th>
                                        <th>Quater</th>                                        
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i = 1; ?>
                                        @if(count($items))
                                            @foreach($items as $item)
                                                @php
                                                    $parentActivity = $item->hasOneParentActivity ? $item->hasOneParentActivity : [];   
                                                    $subActivities = $item->hasManySubActivity ? $item->hasManySubActivity : [];   
                                                    $department = $item->hasOneDepartment ? $item->hasOneDepartment : [];   
                                                @endphp
                                                @include('admin.activity.index-tr',['item'=>$item,'index'=>$i, 'type'=>'parent'])
                                                <?php $i++; ?>
                                                @if(count($subActivities))
                                                    @foreach ($subActivities as $item)
                                                        @include('admin.activity.index-tr',['item'=>$item,'index'=>$i,'type'=>'sub'])
                                                        @php 
                                                            $i++; 
                                                            $subActivitiesOne = $item->hasManySubActivity ? $item->hasManySubActivity : [];   
                                                        @endphp
                                                        @foreach ($subActivitiesOne as $subActivitiesTwo)
                                                            @include('admin.activity.index-tr',['item'=>$subActivitiesTwo,'index'=>$i,'type'=>'subOne'])
                                                            @php 
                                                                $i++; 
                                                            @endphp
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                                
                                            @endforeach
                                        @endif

                                    
                                    <thead>
                                    <tr>
                                        <th class="checkbox_custom_style text-center">
                                            <input name="selectBottom" type="checkbox" id="md_checkbox_footer"
                                                   class="chk-col-cyan"/>
                                            <label for="md_checkbox_footer"></label>
                                        </th>

                                        <th>Activity code</th>
                                        <th>Activity</th>
                                        <th>Department</th>
                                        <th>Quater</th>                                        
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    </tbody>
                                </table>
                            </div>

                            <div class="row body">
                                <div class="container">
                                    <div class="activity-main-btn">
                                        <a class="btn btn-xs btn-info waves-effect"
                                       href="@if(!empty($project)){{ route($ParentRouteName,['projectId'=>$project->id])  }}@else {{ route($ParentRouteName)  }} @endif">All({{ $ModelName::where('project_id',$project->id)->get()->count() }})</a>
                                    
                                    <a @if ( $trash_show==0)
                                       class="dis-none"
                                       @endif
                                        class="btn btn-xs btn-danger"
                                       href="@if(!empty($project)){{ route($ParentRouteName.'.trashed',['projectId'=>$project->id])  }}@else {{ route($ParentRouteName.'.trashed')  }} @endif">Trash({{ $ModelName::onlyTrashed()->count()  }}
                                        )</a>
                                    </div>

                                </div>
                                @if($project->status == 8)
                                    <div class="m-0 col-md-2 col-lg-2 col-sm-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_bottom" id="">
                                                    <option value="0">Select Action</option>
                                                    @if ($delete)
                                                        <option value="3">Move To trash</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info" type="submit" value="Apply"
                                                name="ApplyButtom">
                                        </div>
                                    </div>
                                @endif
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



