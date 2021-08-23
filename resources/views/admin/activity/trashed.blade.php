@extends('layouts.app')


{{--Important Variables--}}

<?php
$moduleName = " Activity";
$createItemName = "Trashed" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Trashed";

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
                <a class="btn btn-sm btn-info" href="{{ url()->previous() }}">Back</a>
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

                            <a @if($all==0)
                               class="dis-none"
                               @endif class="text-black btn btn-xs btn-success"
                               href="{{ route($ParentRouteName)  }}">All({{ $ModelName::all()->count() }})</a>


                            <a class="btn btn-xs btn-danger "
                               href="{{ route($ParentRouteName.'.trashed') }}">Trash({{ $ModelName::onlyTrashed()->count()  }}
                                )</a>

                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName.'.trashed.search') }}"
                                      method="get">
                                    {{ csrf_field() }}
                                    <input type="search" name="search" class="form-control input-sm "
                                           placeholder="Search"/>
                                </form>
                            </ul>
                        </div>
                        <form class="actionForm" action="{{ route($ParentRouteName.'.trashed.action') }}" method="get">

                            <div class="body table-responsive">
                                <div class="row">
                                    <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_top" id="">
                                                    <option value="0">Select Action</option>
                                                    @if ($restore)
                                                        <option value="1">Restore</option>
                                                    @endif
                                                    @if ($permanently_delete)
                                                        <option value="2">Delete</option>
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
                                    </div>
                                    <div class=" margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
                                        <div class="custom-paginate pull-right">
                                            {{ $items->links() }}
                                        </div>
                                    </div>
                                </div>
                                {{ csrf_field() }}

                                @if(count($items)>0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th class="checkbox_custom_style text-center">
                                                <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                       class="chk-col-cyan"/>
                                                <label for="md_checkbox_p"></label>
                                            </th>

                                            <th>Activity</th>
                                            <th>Sub Activity</th>
                                            <th>Status</th>                                        
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $i = 1; ?>
                                        @foreach($items as $item)

                                            <tr>
                                                <th class="text-center">
                                                    <input name="items[id][]" value="{{ $item->id }}"
                                                           type="checkbox" id="md_checkbox_{{ $i }}"
                                                           class="chk-col-cyan selects "/>
                                                    <label for="md_checkbox_{{ $i }}"></label>
                                                </th>

                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    @if($item->status == "1")
                                                        <span class="label label-warning">Started</span>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu animated zoomIn">
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/started">Started</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/in_progress">In Progress</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/cancel">Cancel</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/on_hold">On Hold</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/completed">Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @elseif($item->status == "2")
                                                        <span class="label label-primary">In Progress</span>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu animated zoomIn">
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/started">Started</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/in_progress">In Progress</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/cancel">Cancel</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/on_hold">On Hold</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/completed">Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @elseif($item->status == "3")
                                                        <span class="label label-danger">Cancel</span>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu animated zoomIn">
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/started">Started</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/in_progress">In Progress</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/cancel">Cancel</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/on_hold">On Hold</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/completed">Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @elseif($item->status == "4")
                                                        <span class="label label-warning">On Hold</span>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu animated zoomIn">
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/started">Started</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/in_progress">In Progress</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/cancel">Cancel</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/on_hold">On Hold</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/completed">Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @elseif($item->status == "5")
                                                        <span class="label label-success">Completed</span>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu animated zoomIn">
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/started">Started</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/in_progress">In Progress</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/cancel">Cancel</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/on_hold">On Hold</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/completed">Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @else
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu animated zoomIn">
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/started">Started</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/in_progress">In Progress</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/cancel">Cancel</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/on_hold">On Hold</a>
                                                                    </li>
                                                                <li>
                                                                    <a href="https://ziscoerp.com/admin/projects/change_status/105/completed">Completed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    </td>
                                                <td class="tdAction ">
                                                    <a @if ($restore==0)
                                                       class="dis-none"
                                                       @endif class="btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteName.'.restore',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Restore"><i
                                                                class="material-icons">restore</i></a>

                                                    <a  data-target="#largeModal"
                                                       class="dis-none btn btn-xs btn-success waves-effect ajaxCall "
                                                       href="{{ route($ParentRouteName.'.show',['id'=>$item ->id])  }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Preview"><i
                                                                class="material-icons">pageview</i></a>


                                                    <a @if ($permanently_delete==0)
                                                       class="dis-none"
                                                       @endif class="btn btn-xs btn-danger waves-effect"
                                                       href="{{ route($ParentRouteName.'.kill',['id'=>$item->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Parmanently Delete?"> <i
                                                                class="material-icons">delete</i></a>

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
                                            <th>Activity</th>
                                            <th>Sub Activity</th>
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
                            <div class="row p-l-30">
                                <div class="m-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="apply_comand_bottom" id="">
                                                <option value="0">Select Action</option>
                                                @if ($restore)
                                                    <option value="1">Restore</option>
                                                @endif
                                                @if ($permanently_delete)
                                                    <option value="2">Delete</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="margin-bottom-0 col-md-2 col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input class="btn btn-sm btn-info" type="submit" value="Apply"
                                               name="ApplyTop">
                                    </div>
                                </div>
                                <div class="margin-bottom-0 col-md-8 col-sm-8 col-xs-8">
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
