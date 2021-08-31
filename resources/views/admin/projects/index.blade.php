@extends('layouts.app')


{{--Important Variable--}}

<?php
// echo 45454; die;

$moduleName = " Project";
$createItemName = "Create" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-user";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Projects';


$ParentRouteName = 'project';


$all = config('role_manage.Project.All');
$create = config('role_manage.Project.Create');
$delete = config('role_manage.Project.Delete');
$edit = config('role_manage.Project.Edit');
$pdf = config('role_manage.Project.Pdf');
$permanently_delete = config('role_manage.Project.PermanentlyDelete');
$restore = config('role_manage.Project.Restore');
$show = config('role_manage.Project.Show');
$trash_show = config('role_manage.Project.TrashShow');

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
            <div class="block-header pull-left">

                <a @if ( $create==0 )
                   class="dis-none"
                   @endif class="btn btn-sm btn-info waves-effect"
                   href="{{ route($ParentRouteName.'.create') }}">Add New </a>
            </div>

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
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
                            <div class="row body">
                                <!-- <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="apply_comand_top" id="">
                                                <option value="0">Select Action</option>

                                                @if ($delete)
                                                    <option value="3">Move To trash</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=" margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input class="btn btn-sm btn-info" type="submit" value="Apply"
                                               name="ApplyTop">
                                    </div>
                                </div> -->
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
                                            <th class="checkbox_custom_style text-center">
                                                <input name="selectTop"  type="checkbox" id="md_checkbox_p"
                                                    class="chk-col-cyan"/>
                                                <label for="md_checkbox_p"></label>
                                            </th>

                                            <th>Project Name</th>
                                            <th>Region</th>
                                            <th>Donor</th>
                                            <!-- <th>Coordinator</th> -->
                                            <th>Start - End</th>
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
                                                <tr @if (Auth::id()==$project->id)

                                                        class="bg-tr"

                                                        @endif >
                                                    <th class="text-center">
                                                        <input name="items[id][]" value="{{ $project->id }}"
                                                            type="checkbox" id="md_checkbox_{{ $i }}"
                                                            class="chk-col-cyan selects "/>
                                                        <label for="md_checkbox_{{ $i }}"></label>
                                                    </th>
                                                    <?php 
                                                    $getdonor = isset($project->hasManyProjecttodonor) ? $project->hasManyProjecttodonor : []; 
                                                    $getregion = isset($project->hasManyProjecttoregion) ? $project->hasManyProjecttoregion : []; 
                                                    $donor = [];
                                                    $region = [];
                                                    if(count($getdonor)){
                                                        foreach($getdonor as $key => $getdonorone){
                                                            isset($getdonorone->hasOneSupportDonor->supportDonor) ? array_push($donor,$getdonorone->hasOneSupportDonor->supportDonor) : '';
                                                        }
                                                    }
                                                    if(count($getregion)){
                                                        foreach($getregion as $key => $getregionone){
                                                            isset($getregionone->hasOneRegion->name) ? array_push($region,$getregionone->hasOneRegion->name) : '';
                                                        }
                                                    }
                                                    ?>
                                                    <td class="w-csm-40"><a href="{{ route('activity',['projectId'=>$project->id]) }}">{{$project->projectName ? $project->projectName : '' }}</a></td>
                                                    <td>{{ implode(',',$region) }}</td>
                                                    <td>{{ implode(',',$donor) }}</td>
                                                    <td>{{ $project->start_date }} <br/>{{ $project->end_date }}</td>
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
                                                        @if($project->status == "8")

                                                            <a @if ($edit==0) class="dis-none" @endif  class="btn btn-xs btn-info waves-effect"
                                                            href="{{ route($ParentRouteName.'.edit',['id'=>$project->id]) }}"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Edit"><i class="material-icons">mode_edit</i></a>
                                                            
                                                            <a data-target="#largeModal"
                                                            class="btn btn-xs btn-success waves-effect ajaxCall hidden"
                                                            href="{{  route($ParentRouteName.'.show',['id'=>$project->id])  }}"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Preview"><i class="material-icons">pageview</i></a>

                                                            <a @if ($delete==0) class="dis-none" @endif  class="btn btn-xs btn-danger waves-effect"
                                                            href="{{ route($ParentRouteName.'.destroy',['id'=>$project->id]) }}" data-toggle="tooltip" data-placement="top" title="Trash"> <i class="material-icons" >delete</i></a>

                                                            <a style="margin-top:5px;background-color:#1f91f3;color:#fff;" class="btn waves-effect" href="{{ route($ParentRouteName.'.update_status',['id'=>encrypt($project->id),'status'=>'1']) }}"  data-toggle="tooltip" data-placement="top" title="Submit"> Submit</a>

                                                        @else
                                                            <a style="background-color:#808080" @if ($edit==0) class="dis-none" @endif  class="btn btn-xs waves-effect"
                                                            data-toggle="tooltip"
                                                            data-placement="top" ><i class="material-icons" style="color:#fff">mode_edit</i></a>
                                                            
                                                            <a style="background-color:#808080" data-target="#largeModal"
                                                            class="btn btn-xs waves-effect ajaxCall hidden"
                                                            data-toggle="tooltip"
                                                            data-placement="top"><i class="material-icons" style="color:#fff">pageview</i></a>

                                                            <span  class="btn btn-xs waves-effect" style="background-color:#808080" ><i class="material-icons"style="color:#fff">delete</i></span>
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

                                            <th>Project Name</th>
                                            <th>Region</th>
                                            <th>Donor</th>
                                            <!-- <th>Coordinator</th> -->
                                            <th>Start - End</th>
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
                                <!-- <div class="m-0 col-md-2 col-lg-2 col-sm-2">
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
                                </div> -->
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
        function fal(){
            return false;
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


    </script>

    {{--All datagrid --}}
    <script src="{{ asset('asset/js/dataTable.js')  }}"></script>
    <script>
        BaseController.init();
    </script>
@endpush



