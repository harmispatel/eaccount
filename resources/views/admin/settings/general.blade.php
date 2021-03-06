@extends('layouts.app')
<style type="text/css">
    .form-group .form-line .btn-group.bootstrap-select {
    width: 100% !important;
}
</style>

{{--Important Variables--}}

<?php

$moduleName = " General Settings Manage";
$createItemName = "Update" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " Update";

$breadcrumbMainIcon = "fas fa-project-diagram";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Setting';
$ParentRouteName = 'settings.general';
$ParentRouteNamesystem = 'settings.system';

$moduleNamesystem = " System Settings Manage";
$createItemNamesystem = "Update" . $moduleNamesystem;


$moduleNamequater = " Quater Settings Manage";
$createItemNamequater = "Update" . $moduleNamequater;


$ParentRouteNamequarter = 'settings.quater';


$moduleNamesmtp = " SMTP Settings Manage";
$createItemNamesmtp = "Update" . $moduleNamesmtp;


$ParentRouteNamesmtp = 'settings.smtp';


$moduleNamebankaccount = " Bank Account Settings Manage";
$createItemNamebankaccount = "Update" . $moduleNamebankaccount;


$ParentRouteNamebankaccount = 'settings.bankaccount';



$moduleNamesupportDonor = " Support Donor Settings Manage";
$createItemNamesupportDonor = "Update" . $moduleNamesupportDonor;

$moduleNameregion = " Region Settings Manage";
$createItemNameregion = "Update" . $moduleNameregion;


$ParentRouteNamesupportDonor = 'settings.supportDonor';

$ParentRouteNameregion = 'settings.region';


$moduleNameorgenozationLeader = " Organization Leadership Settings Manage";
$createItemNameorgenozationLeader = "Update" . $moduleNameorgenozationLeader;


$moduleNamecostType = "Cost Type";
$createItemNamecostType = "Update " . $moduleNamecostType;

$ParentRouteNameorgenozationLeader = 'settings.organizationLeader';
$ParentRouteNamecostType = 'settings.costType';




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

            <ol class="breadcrumb breadcrumb-col-cyan pull-right">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="{{ route($ParentRouteName) }}"> <i
                                class="material-icons">settings</i>{{  $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i
                            class="material-icons">{{ $breadcrumbCurrentIcon  }}</i> {{ $breadcrumbCurrentName  }}</li>
            </ol>

            <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <ul class="nav nav-tabs">
                            <!-- <li class="active"><a href="{{ route($ParentRouteName) }}">General</a></li> -->
                            <li class="active"><a data-toggle="tab" href="#generalsetting">General</a></li>
                            <!-- <li><a href="{{ route($ParentRouteNamesystem) }}">System</a></li> -->
                            <li><a data-toggle="tab" href="#systemsetting">System</a></li>
                            <li><a data-toggle="tab" href="#Quatersetting">Quarter</a></li>
                            <!-- <li><a data-toggle="tab" href="#smtpsetting">SMTP</a></li> -->
                            <li><a data-toggle="tab" href="#bankaccountsetting">Bank account</a></li>
                            <li><a data-toggle="tab" href="#supportDonorsetting">Support Donors</a></li>
                            <li><a data-toggle="tab" href="#orgenizationLeader">Organization Leader</a></li>
                            <li><a data-toggle="tab" href="#region">Region</a></li>
                            <li><a data-toggle="tab" href="#costType">Cost Type</a></li>
                        </ul>
                    <div class="tab-content">
                         <!-- general setting start -->

                        <div id="generalsetting" class="tab-pane fade in active">
                            <div class="header">
                                <h2>
                                    {{ $createItemName  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteName.'.update') }}">

                                        {{ csrf_field() }}
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['company_name']  }}" name="company_name" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Company Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['contract_person']  }}" name="contract_person" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Contact Person</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['email']  }}" name="email" type="email"
                                                               class="form-control">
                                                        <label class="form-label">Email</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['phone']  }}"  name="phone" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Phone</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['address_1']  }}"  name="address_1" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Address Line 1</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['address_2']  }}"  name="address_2" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Address Line 2</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['city']  }}"  name="city" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Region</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['state']  }}"  name="state" type="text"
                                                               class="form-control">
                                                        <label class="form-label">District</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['zip_code']  }}"  name="zip_code" type="text"
                                                               class="form-control">
                                                        <label class="form-label">P.O Box</label>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            
                                            
                                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                                <div class="form-group ">
                                                    <div class="form-line">
                                                        <input name="company_logo" type="file" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <img class="width-50 height-50"
                                                     src="{{ asset($generalsettings['company_logo'])  }} " alt="">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- general setting end -->

                        <!-- system setting start -->

                        <div id="systemsetting" class="tab-pane fade">
                            <div class="header">
                                <h2>
                                    {{ $createItemNamesystem  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNamesystem.'.update') }}">

                                        {{ csrf_field() }}
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <p>Date Format</p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select data-live-search="true" class="form-control show-tick"
                                                                name="date_format"
                                                                id="">
                                                            <option @if ( $systemdata['date_format']=='d-m-Y' )
                                                                    selected=""
                                                                    @endif value="d-m-Y">dd-mm-YYYY (05-12-2019)
                                                            </option>

                                                            <option @if ( $systemdata['date_format']=='m-d-Y' )
                                                                    selected=""
                                                                    @endif value="m-d-Y">mm-dd-YYYY (12-05-2019)
                                                            </option>

                                                            <option @if ( $systemdata['date_format']=='d-M-Y' )
                                                                    selected=""
                                                                    @endif value="d-M-Y">dd-MM-YYYY (05-Dec-2019)
                                                            </option>
                                                            <option @if ( $systemdata['date_format']=='M-d-Y' )
                                                                    selected=""
                                                                    @endif value="M-d-Y">MM-dd-YYYY (Dec-05-2019)
                                                            </option>
                                                            <option @if ( $systemdata['date_format']=='M d, Y' )
                                                                    selected=""
                                                                    @endif value="M d, Y">MM dd, YYYY (Dec 05, 2019)
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <p>Timezone</p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select data-live-search="true" class="form-control show-tick"
                                                                name="timezone"
                                                                id="">
                                                            <option @if ( $systemdata['timezone']=='Pacific/Midway' )
                                                                    selected=""
                                                                    @endif value="Pacific/Midway">(GMT-11:00) Midway Island
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/Samoa' )
                                                                    selected=""
                                                                    @endif value="US/Samoa">(GMT-11:00) Samoa
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/Hawaii' )
                                                                    selected=""
                                                                    @endif value="US/Hawaii">(GMT-10:00) Hawaii
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/Alaska' )
                                                                    selected=""
                                                                    @endif value="US/Alaska">(GMT-09:00) Alaska
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/Pacific' )
                                                                    selected=""
                                                                    @endif value="US/Pacific">(GMT-08:00) Pacific Time (US
                                                                &amp;
                                                                Canada)
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Tijuana' )
                                                                    selected=""
                                                                    @endif value="America/Tijuana">(GMT-08:00) Tijuana
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/Arizona' )
                                                                    selected=""
                                                                    @endif value="US/Arizona">(GMT-07:00) Arizona
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/Mountain' )
                                                                    selected=""
                                                                    @endif value="US/Mountain">(GMT-07:00) Mountain Time (US
                                                                &amp;
                                                                Canada)
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Chihuahua' )
                                                                    selected=""
                                                                    @endif value="America/Chihuahua">(GMT-07:00) Chihuahua
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Mazatlan' )
                                                                    selected=""
                                                                    @endif value="America/Mazatlan">(GMT-07:00) Mazatlan
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Mexico_City' )
                                                                    selected=""
                                                                    @endif value="America/Mexico_City">(GMT-06:00) Mexico
                                                                City
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Monterrey' )
                                                                    selected=""
                                                                    @endif value="America/Monterrey">(GMT-06:00) Monterrey
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Canada/Saskatchewan' )
                                                                    selected=""
                                                                    @endif value="Canada/Saskatchewan">(GMT-06:00)
                                                                Saskatchewan
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/Central' )
                                                                    selected=""
                                                                    @endif value="US/Central">(GMT-06:00) Central Time (US
                                                                &amp;
                                                                Canada)
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/Eastern' )
                                                                    selected=""
                                                                    @endif value="US/Eastern">(GMT-05:00) Eastern Time (US
                                                                &amp;
                                                                Canada)
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='US/East-Indiana' )
                                                                    selected=""
                                                                    @endif value="US/East-Indiana">(GMT-05:00) Indiana
                                                                (East)
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Bogota' )
                                                                    selected=""
                                                                    @endif value="America/Bogota">(GMT-05:00) Bogota
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Lima' )
                                                                    selected=""
                                                                    @endif value="America/Lima">(GMT-05:00) Lima
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Caracas' )
                                                                    selected=""
                                                                    @endif value="America/Caracas">(GMT-04:30) Caracas
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Canada/Atlantic' )
                                                                    selected=""
                                                                    @endif value="Canada/Atlantic">(GMT-04:00) Atlantic Time
                                                                (Canada)
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/La_Paz' )
                                                                    selected=""
                                                                    @endif value="America/La_Paz">(GMT-04:00) La Paz
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Santiago' )
                                                                    selected=""
                                                                    @endif value="America/Santiago">(GMT-04:00) Santiago
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Canada/Newfoundland' )
                                                                    selected=""
                                                                    @endif value="Canada/Newfoundland">(GMT-03:30)
                                                                Newfoundland
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='America/Buenos_Aires' )
                                                                    selected=""
                                                                    @endif value="America/Buenos_Aires">(GMT-03:00) Buenos
                                                                Aires
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Greenland' )
                                                                    selected=""
                                                                    @endif value="Greenland">(GMT-03:00) Greenland
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Atlantic/Stanley' )
                                                                    selected=""
                                                                    @endif value="Atlantic/Stanley">(GMT-02:00) Stanley
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Atlantic/Azores' )
                                                                    selected=""
                                                                    @endif value="Atlantic/Azores">(GMT-01:00) Azores
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Atlantic/Cape_Verde' )
                                                                    selected=""
                                                                    @endif value="Atlantic/Cape_Verde">(GMT-01:00) Cape
                                                                Verde Is.
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Africa/Casablanca' )
                                                                    selected=""
                                                                    @endif value="Africa/Casablanca">(GMT) Casablanca
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Dublin' )
                                                                    selected=""
                                                                    @endif value="Europe/Dublin">(GMT) Dublin
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Lisbon' )
                                                                    selected=""
                                                                    @endif value="Europe/Lisbon">(GMT) Lisbon
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/London' )
                                                                    selected=""
                                                                    @endif value="Europe/London">(GMT) London
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Africa/Monrovia' )
                                                                    selected=""
                                                                    @endif value="Africa/Monrovia">(GMT) Monrovia
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Amsterdam' )
                                                                    selected=""
                                                                    @endif value="Europe/Amsterdam">(GMT+01:00) Amsterdam
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Belgrade' )
                                                                    selected=""
                                                                    @endif value="Europe/Belgrade">(GMT+01:00) Belgrade
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Berlin' )
                                                                    selected=""
                                                                    @endif value="Europe/Berlin">(GMT+01:00) Berlin
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Bratislava' )
                                                                    selected=""
                                                                    @endif value="Europe/Bratislava">(GMT+01:00) Bratislava
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Brussels' )
                                                                    selected=""
                                                                    @endif value="Europe/Brussels">(GMT+01:00) Brussels
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Budapest' )
                                                                    selected=""
                                                                    @endif value="Europe/Budapest">(GMT+01:00) Budapest
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Copenhagen' )
                                                                    selected=""
                                                                    @endif value="Europe/Copenhagen">(GMT+01:00) Copenhagen
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Ljubljana' )
                                                                    selected=""
                                                                    @endif value="Europe/Ljubljana">(GMT+01:00) Ljubljana
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Madrid' )
                                                                    selected=""
                                                                    @endif value="Europe/Madrid">(GMT+01:00) Madrid
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Paris' )
                                                                    selected=""
                                                                    @endif value="Europe/Paris">(GMT+01:00) Paris
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Prague' )
                                                                    selected=""
                                                                    @endif value="Europe/Prague">(GMT+01:00) Prague
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Rome' )
                                                                    selected=""
                                                                    @endif value="Europe/Rome">(GMT+01:00) Rome
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Sarajevo' )
                                                                    selected=""
                                                                    @endif value="Europe/Sarajevo">(GMT+01:00) Sarajevo
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Skopje' )
                                                                    selected=""
                                                                    @endif value="Europe/Skopje">(GMT+01:00) Skopje
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Stockholm' )
                                                                    selected=""
                                                                    @endif value="Europe/Stockholm">(GMT+01:00) Stockholm
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Vienna' )
                                                                    selected=""
                                                                    @endif value="Europe/Vienna">(GMT+01:00) Vienna
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Warsaw' )
                                                                    selected=""
                                                                    @endif value="Europe/Warsaw">(GMT+01:00) Warsaw
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Zagreb' )
                                                                    selected=""
                                                                    @endif value="Europe/Zagreb">(GMT+01:00) Zagreb
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Athens' )
                                                                    selected=""
                                                                    @endif value="Europe/Athens">(GMT+02:00) Athens
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Bucharest' )
                                                                    selected=""
                                                                    @endif value="Europe/Bucharest">(GMT+02:00) Bucharest
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Africa/Cairo' )
                                                                    selected=""
                                                                    @endif value="Africa/Cairo">(GMT+02:00) Cairo
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Africa/Harare' )
                                                                    selected=""
                                                                    @endif value="Africa/Harare">(GMT+02:00) Harare
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Helsinki' )
                                                                    selected=""
                                                                    @endif value="Europe/Helsinki">(GMT+02:00) Helsinki
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Istanbul' )
                                                                    selected=""
                                                                    @endif value="Europe/Istanbul">(GMT+02:00) Istanbul
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Jerusalem' )
                                                                    selected=""
                                                                    @endif value="Asia/Jerusalem">(GMT+02:00) Jerusalem
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Kiev' )
                                                                    selected=""
                                                                    @endif value="Europe/Kiev">(GMT+02:00) Kyiv
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Minsk' )
                                                                    selected=""
                                                                    @endif value="Europe/Minsk">(GMT+02:00) Minsk
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Riga' )
                                                                    selected=""
                                                                    @endif value="Europe/Riga">(GMT+02:00) Riga
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Sofia' )
                                                                    selected=""
                                                                    @endif value="Europe/Sofia">(GMT+02:00) Sofia
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Tallinn' )
                                                                    selected=""
                                                                    @endif value="Europe/Tallinn">(GMT+02:00) Tallinn
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Vilnius' )
                                                                    selected=""
                                                                    @endif value="Europe/Vilnius">(GMT+02:00) Vilnius
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Baghdad' )
                                                                    selected=""
                                                                    @endif value="Asia/Baghdad">(GMT+03:00) Baghdad
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Kuwait' )
                                                                    selected=""
                                                                    @endif value="Asia/Kuwait">(GMT+03:00) Kuwait
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Africa/Nairobi' )
                                                                    selected=""
                                                                    @endif value="Africa/Nairobi">(GMT+03:00) Nairobi
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Riyadh' )
                                                                    selected=""
                                                                    @endif value="Asia/Riyadh">(GMT+03:00) Riyadh
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Moscow' )
                                                                    selected=""
                                                                    @endif value="Europe/Moscow">(GMT+03:00) Moscow
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Tehran' )
                                                                    selected=""
                                                                    @endif value="Asia/Tehran">(GMT+03:30) Tehran
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Baku' )
                                                                    selected=""
                                                                    @endif value="Asia/Baku">(GMT+04:00) Baku
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Europe/Volgograd' )
                                                                    selected=""
                                                                    @endif value="Europe/Volgograd">(GMT+04:00) Volgograd
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Muscat' )
                                                                    selected=""
                                                                    @endif value="Asia/Muscat">(GMT+04:00) Muscat
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Tbilisi' )
                                                                    selected=""
                                                                    @endif value="Asia/Tbilisi">(GMT+04:00) Tbilisi
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Yerevan' )
                                                                    selected=""
                                                                    @endif value="Asia/Yerevan">(GMT+04:00) Yerevan
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Kabul' )
                                                                    selected=""
                                                                    @endif value="Asia/Kabul">(GMT+04:30) Kabul
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Karachi' )
                                                                    selected=""
                                                                    @endif value="Asia/Karachi">(GMT+05:00) Karachi
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Tashkent' )
                                                                    selected=""
                                                                    @endif value="Asia/Tashkent">(GMT+05:00) Tashkent
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Kolkata' )
                                                                    selected=""
                                                                    @endif value="Asia/Kolkata">(GMT+05:30) Kolkata
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Kathmandu' )
                                                                    selected=""
                                                                    @endif value="Asia/Kathmandu">(GMT+05:45) Kathmandu
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Yekaterinburg' )
                                                                    selected=""
                                                                    @endif value="Asia/Yekaterinburg">(GMT+06:00)
                                                                Ekaterinburg
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Almaty' )
                                                                    selected=""
                                                                    @endif value="Asia/Almaty">(GMT+06:00) Almaty
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Dhaka' )
                                                                    selected=""
                                                                    @endif value="Asia/Dhaka">(GMT+06:00) Dhaka
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Novosibirsk' )
                                                                    selected=""
                                                                    @endif value="Asia/Novosibirsk">(GMT+07:00) Novosibirsk
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Bangkok' )
                                                                    selected=""
                                                                    @endif value="Asia/Bangkok">(GMT+07:00) Bangkok
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Jakarta' )
                                                                    selected=""
                                                                    @endif value="Asia/Jakarta">(GMT+07:00) Jakarta
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Krasnoyarsk' )
                                                                    selected=""
                                                                    @endif value="Asia/Krasnoyarsk">(GMT+08:00) Krasnoyarsk
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Chongqing' )
                                                                    selected=""
                                                                    @endif value="Asia/Chongqing">(GMT+08:00) Chongqing
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Hong_Kong' )
                                                                    selected=""
                                                                    @endif value="Asia/Hong_Kong">(GMT+08:00) Hong Kong
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Kuala_Lumpur' )
                                                                    selected=""
                                                                    @endif value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala
                                                                Lumpur
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Australia/Perth' )
                                                                    selected=""
                                                                    @endif value="Australia/Perth">(GMT+08:00) Perth
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Singapore' )
                                                                    selected=""
                                                                    @endif value="Asia/Singapore">(GMT+08:00) Singapore
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Taipei' )
                                                                    selected=""
                                                                    @endif value="Asia/Taipei">(GMT+08:00) Taipei
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Ulaanbaatar' )
                                                                    selected=""
                                                                    @endif value="Asia/Ulaanbaatar">(GMT+08:00) Ulaan Bataar
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Urumqi' )
                                                                    selected=""
                                                                    @endif value="Asia/Urumqi">(GMT+08:00) Urumqi
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Irkutsk' )
                                                                    selected=""
                                                                    @endif value="Asia/Irkutsk">(GMT+09:00) Irkutsk
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Seoul' )
                                                                    selected=""
                                                                    @endif value="Asia/Seoul">(GMT+09:00) Seoul
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Tokyo' )
                                                                    selected=""
                                                                    @endif value="Asia/Tokyo">(GMT+09:00) Tokyo
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Australia/Adelaide' )
                                                                    selected=""
                                                                    @endif value="Australia/Adelaide">(GMT+09:30) Adelaide
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Australia/Darwin' )
                                                                    selected=""
                                                                    @endif value="Australia/Darwin">(GMT+09:30) Darwin
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Yakutsk' )
                                                                    selected=""
                                                                    @endif value="Asia/Yakutsk">(GMT+10:00) Yakutsk
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Australia/Brisbane' )
                                                                    selected=""
                                                                    @endif value="Australia/Brisbane">(GMT+10:00) Brisbane
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Australia/Canberra' )
                                                                    selected=""
                                                                    @endif value="Australia/Canberra">(GMT+10:00) Canberra
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Pacific/Guam' )
                                                                    selected=""
                                                                    @endif value="Pacific/Guam">(GMT+10:00) Guam
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Australia/Hobart' )
                                                                    selected=""
                                                                    @endif value="Australia/Hobart">(GMT+10:00) Hobart
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Australia/Melbourne' )
                                                                    selected=""
                                                                    @endif value="Australia/Melbourne">(GMT+10:00) Melbourne
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Pacific/Port_Moresby' )
                                                                    selected=""
                                                                    @endif value="Pacific/Port_Moresby">(GMT+10:00) Port
                                                                Moresby
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Australia/Sydney' )
                                                                    selected=""
                                                                    @endif value="Australia/Sydney">(GMT+10:00) Sydney
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Vladivostok' )
                                                                    selected=""
                                                                    @endif value="Asia/Vladivostok">(GMT+11:00) Vladivostok
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Asia/Magadan' )
                                                                    selected=""
                                                                    @endif value="Asia/Magadan">(GMT+12:00) Magadan
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Pacific/Auckland' )
                                                                    selected=""
                                                                    @endif value="Pacific/Auckland">(GMT+12:00) Auckland
                                                            </option>
                                                            <option @if ( $systemdata['timezone']=='Pacific/Fiji' )
                                                                    selected=""
                                                                    @endif value="Pacific/Fiji">(GMT+12:00) Fiji
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <p>Currency Code</p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select name="currency_code" data-live-search="true"
                                                                class="form-control show-tick"
                                                        >
                                                            <option @if ($systemdata['currency_code']=='BDT')
                                                                    selected=""
                                                                    @endif value="BDT">BDT
                                                            </option>

                                                            <option @if ($systemdata['currency_code']=='USD')
                                                                    selected=""
                                                                    @endif value="USD">USD
                                                            </option>
                                                            <option @if ($systemdata['currency_code']=='INR')
                                                                    selected=""
                                                                    @endif value="INR">INR
                                                            </option>
                                                            <option @if ($systemdata['currency_code']=='GBP')
                                                                    selected=""
                                                                    @endif value="GBP">GBP
                                                            </option>
                                                            <option @if ($systemdata['currency_code']=='JPY')
                                                                    selected=""
                                                                    @endif value="JPY">JPY
                                                            </option>
                                                            <option @if ($systemdata['currency_code']=='TZS')
                                                                    selected=""
                                                                    @endif value="TZS">TZS
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <p>Currency Symbol </p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select name="currency_symbol" data-live-search="true"
                                                                class="form-control show-tick"
                                                        >
                                                            <option @if ($systemdata['currency_symbol']=='???')
                                                                    selected=""
                                                                    @endif value="???">TK &#2547;
                                                            </option>

                                                            <option @if ($systemdata['currency_symbol']=='$')
                                                                    selected=""
                                                                    @endif value="$">USD &#36;
                                                            </option>

                                                            <option @if ($systemdata['currency_symbol']=='???')
                                                                    selected=""
                                                                    @endif value="???">Rupee &#8377;
                                                            </option>
                                                            <option @if ($systemdata['currency_symbol']=='??')
                                                                    selected=""
                                                                    @endif value="??">Pounds sterling &#163;
                                                            </option>
                                                            <option @if ($systemdata['currency_symbol']=='??')
                                                                    selected=""
                                                                    @endif value="??">Japanese yen &#165;
                                                            </option>
                                                            <option @if ($systemdata['currency_symbol']=='TZS')
                                                                    selected=""
                                                                    @endif value="TZS">TZS (has no symbol)
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <p>Currency (Symbol/Code)</p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick"
                                                                name="is_code"
                                                                id="">
                                                            <option @if ( $systemdata['is_code']=='none' )
                                                                    selected=""
                                                                    @endif value="none">None
                                                            </option>
                                                            <option @if ( $systemdata['is_code']=='code' )
                                                                    selected=""
                                                                    @endif value="code">Currency Code
                                                            </option>
                                                            <option @if ( $systemdata['is_code']=='symbol' )
                                                                    selected=""
                                                                    @endif value="symbol">Currency Symbol
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <p>Currency Position</p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick"
                                                                name="currency_position"
                                                                id="">
                                                            <option @if ( $systemdata['currency_position']=='Prefix' )
                                                                    selected=""
                                                                    @endif value="Prefix">Prefix
                                                            </option>
                                                            <option @if ( $systemdata['currency_position']=='Suffix' )
                                                                    selected=""
                                                                    @endif value="Suffix">Suffix
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 field_area">
                                                <p>First Transaction Date</p>
                                                <div class="form-group form-float">
                                                    <div class="form-line" id="bs_datepicker_container">
                                                        <input autocomplete="off" value="{{ date('d/m/Y', strtotime($systemdata['fixed_asset_schedule_starting_date']))  }}"
                                                               name="fixed_asset_schedule_starting_date"
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="Please choose a date...">
                                                    </div>
                                                </div>
                                            </div>


                                          

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- quarter setting end -->

                        <div id="Quatersetting" class="tab-pane fade">
                            <div class="header">
                                <h2>
                                    {{ $createItemNamequater  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNamequarter.'.update') }}">

                                        {{ csrf_field() }}
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <label class="form-label">Quarter 1</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-line focused">
                                                                <label>Start</label>
                                                                <select id="Quarter1_Start" name="Quarter1_Start"  placeholder="Start">
                                                                    <option value="January" <?php if($quarterdata['Quarter1_Start'] == "January") { echo 'selected'; } ?>>January</option>
                                                                    <option value="February" <?php if($quarterdata['Quarter1_Start'] == "February") { echo 'selected'; } ?>>February</option>
                                                                    <option value="March" <?php if($quarterdata['Quarter1_Start'] == "March") { echo 'selected'; } ?>>March</option>
                                                                    <option value="April" <?php if($quarterdata['Quarter1_Start'] == "April") { echo 'selected'; } ?>>April</option>
                                                                    <option value="May" <?php if($quarterdata['Quarter1_Start'] == "May") { echo 'selected'; } ?>>May</option>
                                                                    <option value="June" <?php if($quarterdata['Quarter1_Start'] == "June") { echo 'selected'; } ?>>June</option>
                                                                    <option value="July" <?php if($quarterdata['Quarter1_Start'] == "July") { echo 'selected'; } ?>>July</option>
                                                                    <option value="August" <?php if($quarterdata['Quarter1_Start'] == "August") { echo 'selected'; } ?>>August</option>
                                                                    <option value="Septmber" <?php if($quarterdata['Quarter1_Start'] == "Septmber") { echo 'selected'; } ?>>Septmber</option>
                                                                    <option value="October" <?php if($quarterdata['Quarter1_Start'] == "October") { echo 'selected'; } ?>>October</option>
                                                                    <option value="November" <?php if($quarterdata['Quarter1_Start'] == "November") { echo 'selected'; } ?>>November</option>
                                                                    <option value="December" <?php if($quarterdata['Quarter1_Start'] == "December") { echo 'selected'; } ?>>December</option>
                                                                </select>
                                                            </div>
                                                        </div>                                                    
                                                        <div class="col-md-6">
                                                            <div class="form-line focused">
                                                                <label>End</label>
                                                                <select id="Quarter1_End" name="Quarter1_End" >
                                                                    <option value="January" <?php if($quarterdata['Quarter1_End'] == "January") { echo 'selected'; } ?>>January</option>
                                                                    <option value="February" <?php if($quarterdata['Quarter1_End'] == "February") { echo 'selected'; } ?>>February</option>
                                                                    <option value="March" <?php if($quarterdata['Quarter1_End'] == "March") { echo 'selected'; } ?>>March</option>
                                                                    <option value="April" <?php if($quarterdata['Quarter1_End'] == "April") { echo 'selected'; } ?>>April</option>
                                                                    <option value="May" <?php if($quarterdata['Quarter1_End'] == "May") { echo 'selected'; } ?>>May</option>
                                                                    <option value="June" <?php if($quarterdata['Quarter1_End'] == "June") { echo 'selected'; } ?>>June</option>
                                                                    <option value="July" <?php if($quarterdata['Quarter1_End'] == "July") { echo 'selected'; } ?>>July</option>
                                                                    <option value="August" <?php if($quarterdata['Quarter1_End'] == "August") { echo 'selected'; } ?>>August</option>
                                                                    <option value="Septmber" <?php if($quarterdata['Quarter1_End'] == "Septmber") { echo 'selected'; } ?>>Septmber</option>
                                                                    <option value="October" <?php if($quarterdata['Quarter1_End'] == "October") { echo 'selected'; } ?>>October</option>
                                                                    <option value="November" <?php if($quarterdata['Quarter1_End'] == "November") { echo 'selected'; } ?>>November</option>
                                                                    <option value="December" <?php if($quarterdata['Quarter1_End'] == "December") { echo 'selected'; } ?>>December</option>
                                                                </select>
                                                            </div>    
                                                        </div>                                                    
                                                    </div>                                                
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <label class="form-label">Quarter 2</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-line focused">
                                                                <label>Start</label>
                                                                <select id="Quarter2_Start" name="Quarter2_Start" onchange="quarter1(this.value)">
                                                                    <option value="January" <?php if($quarterdata['Quarter2_Start'] == "January") { echo 'selected'; } ?>>January</option>
                                                                    <option value="February" <?php if($quarterdata['Quarter2_Start'] == "February") { echo 'selected'; } ?>>February</option>
                                                                    <option value="March" <?php if($quarterdata['Quarter2_Start'] == "March") { echo 'selected'; } ?>>March</option>
                                                                    <option value="April" <?php if($quarterdata['Quarter2_Start'] == "April") { echo 'selected'; } ?>>April</option>
                                                                    <option value="May" <?php if($quarterdata['Quarter2_Start'] == "May") { echo 'selected'; } ?>>May</option>
                                                                    <option value="June" <?php if($quarterdata['Quarter2_Start'] == "June") { echo 'selected'; } ?>>June</option>
                                                                    <option value="July" <?php if($quarterdata['Quarter2_Start'] == "July") { echo 'selected'; } ?>>July</option>
                                                                    <option value="August" <?php if($quarterdata['Quarter2_Start'] == "August") { echo 'selected'; } ?>>August</option>
                                                                    <option value="Septmber" <?php if($quarterdata['Quarter2_Start'] == "Septmber") { echo 'selected'; } ?>>Septmber</option>
                                                                    <option value="October" <?php if($quarterdata['Quarter2_Start'] == "October") { echo 'selected'; } ?>>October</option>
                                                                    <option value="November" <?php if($quarterdata['Quarter2_Start'] == "November") { echo 'selected'; } ?>>November</option>
                                                                    <option value="December" <?php if($quarterdata['Quarter2_Start'] == "December") { echo 'selected'; } ?>>December</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-line focused">
                                                                <label>End</label>
                                                                <select id="Quarter2_End" name="Quarter2_End" onchange="quarter1(this.value)">
                                                                    <option value="January" <?php if($quarterdata['Quarter2_End'] == "January") { echo 'selected'; } ?>>January</option>
                                                                    <option value="February" <?php if($quarterdata['Quarter2_End'] == "February") { echo 'selected'; } ?>>February</option>
                                                                    <option value="March" <?php if($quarterdata['Quarter2_End'] == "March") { echo 'selected'; } ?>>March</option>
                                                                    <option value="April" <?php if($quarterdata['Quarter2_End'] == "April") { echo 'selected'; } ?>>April</option>
                                                                    <option value="May" <?php if($quarterdata['Quarter2_End'] == "May") { echo 'selected'; } ?>>May</option>
                                                                    <option value="June" <?php if($quarterdata['Quarter2_End'] == "June") { echo 'selected'; } ?>>June</option>
                                                                    <option value="July" <?php if($quarterdata['Quarter2_End'] == "July") { echo 'selected'; } ?>>July</option>
                                                                    <option value="August" <?php if($quarterdata['Quarter2_End'] == "August") { echo 'selected'; } ?>>August</option>
                                                                    <option value="Septmber" <?php if($quarterdata['Quarter2_End'] == "Septmber") { echo 'selected'; } ?>>Septmber</option>
                                                                    <option value="October" <?php if($quarterdata['Quarter2_End'] == "October") { echo 'selected'; } ?>>October</option>
                                                                    <option value="November" <?php if($quarterdata['Quarter2_End'] == "November") { echo 'selected'; } ?>>November</option>
                                                                    <option value="December" <?php if($quarterdata['Quarter2_End'] == "December") { echo 'selected'; } ?>>December</option>
                                                                </select>
                                                            </div>    
                                                        </div>                                                    
                                                    </div>                                                
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <label class="form-label">Quarter 3</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-line focused">
                                                                <label>Start</label>
                                                                <select id="Quarter3_Start" name="Quarter3_Start" onchange="quarter1(this.value)">
                                                                    <option value="January" <?php if($quarterdata['Quarter3_Start'] == "January") { echo 'selected'; } ?>>January</option>
                                                                    <option value="February" <?php if($quarterdata['Quarter3_Start'] == "February") { echo 'selected'; } ?>>February</option>
                                                                    <option value="March" <?php if($quarterdata['Quarter3_Start'] == "March") { echo 'selected'; } ?>>March</option>
                                                                    <option value="April" <?php if($quarterdata['Quarter3_Start'] == "April") { echo 'selected'; } ?>>April</option>
                                                                    <option value="May" <?php if($quarterdata['Quarter3_Start'] == "May") { echo 'selected'; } ?>>May</option>
                                                                    <option value="June" <?php if($quarterdata['Quarter3_Start'] == "June") { echo 'selected'; } ?>>June</option>
                                                                    <option value="July" <?php if($quarterdata['Quarter3_Start'] == "July") { echo 'selected'; } ?>>July</option>
                                                                    <option value="August" <?php if($quarterdata['Quarter3_Start'] == "August") { echo 'selected'; } ?>>August</option>
                                                                    <option value="Septmber" <?php if($quarterdata['Quarter3_Start'] == "Septmber") { echo 'selected'; } ?>>Septmber</option>
                                                                    <option value="October" <?php if($quarterdata['Quarter3_Start'] == "October") { echo 'selected'; } ?>>October</option>
                                                                    <option value="November" <?php if($quarterdata['Quarter3_Start'] == "November") { echo 'selected'; } ?>>November</option>
                                                                    <option value="December" <?php if($quarterdata['Quarter3_Start'] == "December") { echo 'selected'; } ?>>December</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-line focused">
                                                                <label>End</label>
                                                                <select id="Quarter3_End" name="Quarter3_End" onchange="quarter1(this.value)">
                                                                    <option value="January" <?php if($quarterdata['Quarter3_End'] == "January") { echo 'selected'; } ?>>January</option>
                                                                    <option value="February" <?php if($quarterdata['Quarter3_End'] == "February") { echo 'selected'; } ?>>February</option>
                                                                    <option value="March" <?php if($quarterdata['Quarter3_End'] == "March") { echo 'selected'; } ?>>March</option>
                                                                    <option value="April" <?php if($quarterdata['Quarter3_End'] == "April") { echo 'selected'; } ?>>April</option>
                                                                    <option value="May" <?php if($quarterdata['Quarter3_End'] == "May") { echo 'selected'; } ?>>May</option>
                                                                    <option value="June" <?php if($quarterdata['Quarter3_End'] == "June") { echo 'selected'; } ?>>June</option>
                                                                    <option value="July" <?php if($quarterdata['Quarter3_End'] == "July") { echo 'selected'; } ?>>July</option>
                                                                    <option value="August" <?php if($quarterdata['Quarter3_End'] == "August") { echo 'selected'; } ?>>August</option>
                                                                    <option value="Septmber" <?php if($quarterdata['Quarter3_End'] == "Septmber") { echo 'selected'; } ?>>Septmber</option>
                                                                    <option value="October" <?php if($quarterdata['Quarter3_End'] == "October") { echo 'selected'; } ?>>October</option>
                                                                    <option value="November" <?php if($quarterdata['Quarter3_End'] == "November") { echo 'selected'; } ?>>November</option>
                                                                    <option value="December" <?php if($quarterdata['Quarter3_End'] == "December") { echo 'selected'; } ?>>December</option>
                                                                </select>
                                                            </div>    
                                                        </div>                                                    
                                                    </div>                                                
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <label class="form-label">Quarter 4</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-line focused">
                                                                <label>Start</label>
                                                                <select id="Quarter4_Start" name="Quarter4_Start" onchange="quarter1(this.value)">
                                                                    <option value="January" <?php if($quarterdata['Quarter4_Start'] == "January") { echo 'selected'; } ?>>January</option>
                                                                    <option value="February" <?php if($quarterdata['Quarter4_Start'] == "February") { echo 'selected'; } ?>>February</option>
                                                                    <option value="March" <?php if($quarterdata['Quarter4_Start'] == "March") { echo 'selected'; } ?>>March</option>
                                                                    <option value="April" <?php if($quarterdata['Quarter4_Start'] == "April") { echo 'selected'; } ?>>April</option>
                                                                    <option value="May" <?php if($quarterdata['Quarter4_Start'] == "May") { echo 'selected'; } ?>>May</option>
                                                                    <option value="June" <?php if($quarterdata['Quarter4_Start'] == "June") { echo 'selected'; } ?>>June</option>
                                                                    <option value="July" <?php if($quarterdata['Quarter4_Start'] == "July") { echo 'selected'; } ?>>July</option>
                                                                    <option value="August" <?php if($quarterdata['Quarter4_Start'] == "August") { echo 'selected'; } ?>>August</option>
                                                                    <option value="Septmber" <?php if($quarterdata['Quarter4_Start'] == "Septmber") { echo 'selected'; } ?>>Septmber</option>
                                                                    <option value="October" <?php if($quarterdata['Quarter4_Start'] == "October") { echo 'selected'; } ?>>October</option>
                                                                    <option value="November" <?php if($quarterdata['Quarter4_Start'] == "November") { echo 'selected'; } ?>>November</option>
                                                                    <option value="December" <?php if($quarterdata['Quarter4_Start'] == "December") { echo 'selected'; } ?>>December</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-line focused">
                                                                <label>End</label>
                                                                <select id="Quarter4_End" name="Quarter4_End" onchange="quarter1(this.value)">
                                                                    <option value="January" <?php if($quarterdata['Quarter4_End'] == "January") { echo 'selected'; } ?>>January</option>
                                                                    <option value="February" <?php if($quarterdata['Quarter4_End'] == "February") { echo 'selected'; } ?>>February</option>
                                                                    <option value="March" <?php if($quarterdata['Quarter4_End'] == "March") { echo 'selected'; } ?>>March</option>
                                                                    <option value="April" <?php if($quarterdata['Quarter4_End'] == "April") { echo 'selected'; } ?>>April</option>
                                                                    <option value="May" <?php if($quarterdata['Quarter4_End'] == "May") { echo 'selected'; } ?>>May</option>
                                                                    <option value="June" <?php if($quarterdata['Quarter4_End'] == "June") { echo 'selected'; } ?>>June</option>
                                                                    <option value="July" <?php if($quarterdata['Quarter4_End'] == "July") { echo 'selected'; } ?>>July</option>
                                                                    <option value="August" <?php if($quarterdata['Quarter4_End'] == "August") { echo 'selected'; } ?>>August</option>
                                                                    <option value="Septmber" <?php if($quarterdata['Quarter4_End'] == "Septmber") { echo 'selected'; } ?>>Septmber</option>
                                                                    <option value="October" <?php if($quarterdata['Quarter4_End'] == "October") { echo 'selected'; } ?>>October</option>
                                                                    <option value="November" <?php if($quarterdata['Quarter4_End'] == "November") { echo 'selected'; } ?>>November</option>
                                                                    <option value="December" <?php if($quarterdata['Quarter4_End'] == "December") { echo 'selected'; } ?>>December</option>
                                                                </select>
                                                            </div>    
                                                        </div>                                                    
                                                    </div>                                                
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- quarter setting start -->

                        <!-- SMTP Setting start -->

                        <!-- <div id="smtpsetting" class="tab-pane fade">
                            <div class="header">
                                <h2>
                                    {{ $createItemNamesmtp  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNamesmtp.'.update') }}">

                                        {{ csrf_field() }}
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['company_name']  }}" name="company_name" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL DRIVER</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['contract_person']  }}" name="contract_person" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL HOST</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['phone']  }}"  name="phone" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL PORT</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['phone']  }}"  name="phone" type="text"
                                                               class="form-control">
                                                        <label class="form-label">MAIL PORT</label>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['address_1']  }}"  name="address_1" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Address Line 1</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['address_2']  }}"  name="address_2" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Address Line 2</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['city']  }}"  name="city" type="text"
                                                               class="form-control">
                                                        <label class="form-label">City</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['state']  }}"  name="state" type="text"
                                                               class="form-control">
                                                        <label class="form-label">State</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="{{ $generalsettings['zip_code']  }}"  name="zip_code" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Zip Code</label>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            
                                            
                                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                                <div class="form-group ">
                                                    <div class="form-line">
                                                        <input name="company_logo" type="file" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <img class="width-50 height-50"
                                                     src="{{ asset($generalsettings['company_logo'])  }} " alt="">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div> -->

                        <!-- SMTP Setting End -->


                        <!-- bank account setting start -->

                        <div id="bankaccountsetting" class="tab-pane fade ">
                            <div class="header">
                                <h2>
                                    {{ $createItemNamebankaccount  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNamebankaccount.'.update') }}">

                                          <?php //echo "<pre>"; print_r($Bankaccountsedit); die; ?>

                                        {{ csrf_field() }}
                                        <input value="@if(!empty($Bankaccountsedit)) {{ $Bankaccountsedit->id }} @endif" name="bankid" type="hidden" >
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="@if(!empty($Bankaccountsedit)) {{ $Bankaccountsedit->bankName }} @endif" name="bankName" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Bank Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                $people = [];
                                                if((!empty($Bankaccountsedit)) && (count($Bankaccountsedit->hasManyBanktoDonor)>0)){
                                                    foreach($Bankaccountsedit->hasManyBanktoDonor as $key => $one){
                                                        array_push($people,$one->donor_id);
                                                    }
                                                }
                                            ?>

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <label class="form-label">Supporting donors</label>
                                                        <select name="donors[]" multiple data-live-search="true" class="form-control show-tick">
                                                        <option value="0">Select Donor</option>
                                                            @if($supportdonor) 
                                                                @foreach($supportdonor as $donor)
                                                                    <option value="{{ $donor->id }}" @if ((!empty($Bankaccountsedit)) && (in_array($donor->id,$people ))) selected @endif>{{ $donor->supportDonor }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="@if(!empty($Bankaccountsedit) && $Bankaccountsedit->bankCode) {{ $Bankaccountsedit->bankCode }} @endif" name="bankCode" type="text" class="form-control" maxlength="5">
                                                        <label class="form-label">Bank code</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <p>Currency Code</p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select name="bankcurrency_code" data-live-search="true"
                                                                class="form-control show-tick"
                                                        >
                                                            <option value="0">Select Currency Code</option>
                                                            <option value="BDT" @if(!empty($Bankaccountsedit)) @if($Bankaccountsedit->bankcurrency_code == "BDT")) {{ "Selected" }} @endif @endif>BDT
                                                            </option>

                                                            <option value="USD" @if(!empty($Bankaccountsedit)) @if($Bankaccountsedit->bankcurrency_code == "USD")) {{ "Selected" }} @endif @endif>USD
                                                            </option>
                                                            <option value="INR" @if(!empty($Bankaccountsedit)) @if($Bankaccountsedit->bankcurrency_code == "INR")) {{ "Selected" }} @endif @endif>INR
                                                            </option>
                                                            <option value="GBP" @if(!empty($Bankaccountsedit)) @if($Bankaccountsedit->bankcurrency_code == "GBP")) {{ "Selected" }} @endif @endif>GBP
                                                            </option>
                                                            <option value="JPY" @if(!empty($Bankaccountsedit)) @if($Bankaccountsedit->bankcurrency_code == "JPY")) {{ "Selected" }} @endif @endif>JPY
                                                            </option>
                                                            <option value="TZS" @if(!empty($Bankaccountsedit)) @if($Bankaccountsedit->bankcurrency_code == "TZS")) {{ "Selected" }} @endif @endif>TZS
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4">
                                                <p>Status</p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select data-live-search="true" class="form-control show-tick" name="bankStatus" id="bankStatus">
                                                            <option value="0">Select Status</option>
                                                            <option value="1" @if(!empty($Bankaccountsedit)) @if($Bankaccountsedit->bankStatus == "1")) {{ "Selected" }} @endif @endif>Active</option>
                                                            <option value="2" @if(!empty($Bankaccountsedit)) @if($Bankaccountsedit->bankStatus == "2")) {{ "Selected" }} @endif @endif>Closed</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">
                                                    @if(!empty($Bankaccountsedit)) 
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        Update
                                                    </button>
                                                    @else
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        Add New
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>


                                <div>
                                    <!-- <form enctype="multipart/form-data" class="form" id="form_validation" method="post" action="{{ route($ParentRouteNamesupportDonor.'.update') }}"> -->
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Bank Name</th>
                                            <th>Donor</th>
                                            <th>Bank Code</th>
                                            <th>Currency Code</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php
                                        // echo "<pre>"; print_r($Bankaccounts); die;
                                         $i = 1; ?>
                                        @if(!empty($Bankaccounts))
                                            @foreach($Bankaccounts as $Bankaccount)
                                            <?php
                                                $getdonor = isset($Bankaccount->hasManyBanktoDonor) ? $Bankaccount->hasManyBanktoDonor : []; 
                                                $donor = [];
                                                if(count($getdonor)>0){
                                                    foreach($getdonor as $key => $getdonorone){
                                                        isset($getdonorone->hasOneSupportDonor->supportDonor) ? array_push($donor,$getdonorone->hasOneSupportDonor->supportDonor) : '';
                                                    }
                                                }
                                            ?> 
                                            <tr>
                                                <td> {{ $Bankaccount->id }}</td>
                                                <td> {{ $Bankaccount->bankName }} </td>
                                                <td> {{ implode(',',$donor) }}</td>
                                                <td> {{ $Bankaccount->bankCode }}</td>
                                                <td> {{ $Bankaccount->bankcurrency_code }}</td>
                                                <td> 
                                                    @if($Bankaccount->bankStatus == "1")
                                                        {{ "Active" }}    
                                                    @else 
                                                        {{ "Closed" }}    
                                                    @endif
                                                    </td>

                                                <td class="tdTrashAction">
                                                    <a class="btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteNamebankaccount.'.edit',['id'=>$Bankaccount->id]) }}/#bankaccountsetting" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="material-icons">mode_edit</i></a>                                    

                                                    <a class="btn btn-xs btn-danger waves-effect" onclick="return confirm('Do you want to Delete?');"
                                                       href="{{ route($ParentRouteNamebankaccount.'.destroy',['id'=>$Bankaccount->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Delete"> <i
                                                                class="material-icons">delete</i></a>


                                                </td>
                                            </tr>
                                        <?php $i++; ?>
                                            @endforeach
                                        @endif
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Bank Name</th>
                                            <th>Donor</th>
                                            <th>Bank Code</th>
                                            <th>Currency Code</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>
                                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Update
                                                </button>
                                            </div>
                                        </div> -->
                                        <!-- </form> -->
                                </div>

                            </div>
                        </div>
                        <!-- bank account setting end -->



                        <!-- Donor setting start -->

                        <div id="supportDonorsetting" class="tab-pane fade ">
                            <div class="header">
                                <h2>
                                    {{ $createItemNamesupportDonor  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNamesupportDonor.'.update') }}">

                                        {{ csrf_field() }}
                                        <input value="@if(!empty($supportdonoredit)) {{ $supportdonoredit->id }} @endif" name="donor_id" type="hidden" >
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="supportDonor" type="text" class="form-control" value="@if(!empty($supportdonoredit)){{ $supportdonoredit->supportDonor }}@endif">
                                                        <label class="form-label">Support Donor</label>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        {{ (!empty($supportdonoredit)) ? "Update" : "Add New" }}
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>


                                <div>
                                    <!-- <form enctype="multipart/form-data" class="form" id="form_validation" method="post" action="{{ route($ParentRouteNamesupportDonor.'.update') }}"> -->
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Donor</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            

                                        <?php $i = 1; ?>
                                        @if(!empty($supportdonor))
                                            @foreach($supportdonor as $donor)
                                                    
                                            <tr>
                                                <td> {{ $donor->id }}</td>
                                                <td>{{ $donor->supportDonor }} </td>
                                                <td class="tdTrashAction">
                                                    <a class="btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteNamesupportDonor.'.edit',['id'=>$donor->id]) }}/#supportDonorsetting" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="material-icons">mode_edit</i></a>      

                                                    <a 
                                                        class="btn btn-xs btn-danger waves-effect" onclick="return confirm('Do you want to Delete?');"
                                                       href="{{ route($ParentRouteNamesupportDonor.'.destroy',['id'=>$donor->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Delete"> <i
                                                                class="material-icons">delete</i></a>


                                                </td>
                                            </tr>
                                        <?php $i++; ?>
                                            @endforeach
                                        @endif
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Donor</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>
                                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Update
                                                </button>
                                            </div>
                                        </div> -->
                                        <!-- </form> -->
                                </div>

                            </div>
                        </div>

                        <!-- Donor setting end -->



                        <!-- Orgenization leadership setting start -->

                        <div id="orgenizationLeader" class="tab-pane fade ">
                            <div class="header">
                                <h2>
                                    {{ $createItemNameorgenozationLeader  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNameorgenozationLeader.'.update') }}">

                                        {{ csrf_field() }}
                                        <input value="@if(!empty($orgenizationleaderedit)) {{ $orgenizationleaderedit->id }} @endif" name="orgid" type="hidden" >
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="@if(!empty($orgenizationleaderedit)) {{ $orgenizationleaderedit->name }} @endif" name="orgenizationLeader" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Organization Leadership</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="@if(!empty($orgenizationleaderedit)) {{ $orgenizationleaderedit->order }} @endif" name="order" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Order</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float" style="margin-top:10px">
                                                    <input type="checkbox" id="budget_approval" name="budget_approval" @if((!empty($orgenizationleaderedit)) && ($orgenizationleaderedit->budget_approval == "1")) checked @endif class="filled-in">
                                                    <label for="budget_approval">Budget Approval</label>
                                                </div>
                                            </div>
      
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">                     
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        {{ (!empty($orgenizationleaderedit)) ? "Update" : "Add New" }}
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>


                                <div>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>name</th>
                                            <th>Budget Approval</th>
                                            <th>Order</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <?php $i = 1; ?>
                                        @if(!empty($orgenizationleader))
                                            @foreach($orgenizationleader as $orgenization)
                                                    
                                            <tr>
                                                <td>{{ $orgenization->id }}</td>
                                                <td>{{ $orgenization->name }}</td>
                                                <td>{{ $orgenization->budget_approval == "1" ? "Yes" : "No" }}</td>
                                                <td>{{ $orgenization->order }}</td>
                                                <td class="tdTrashAction">
                                                    <a class="btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteNameorgenozationLeader.'.edit',['id'=>$orgenization->id]) }}/#orgenizationLeader" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="material-icons">mode_edit</i></a>      

                                                    <a 
                                                        class="btn btn-xs btn-danger waves-effect" onclick="return confirm('Do you want to Delete?');"
                                                       href="{{ route($ParentRouteNameorgenozationLeader.'.destroy',['id'=>$orgenization->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Delete"> <i
                                                                class="material-icons">delete</i></a>


                                                </td>
                                            </tr>
                                        <?php $i++; ?>
                                            @endforeach
                                        @endif
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Budget Approval</th>
                                            <th>Order</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                        <!-- Orgenization leadership setting end -->

                        <!-- Region setting start -->

                        <div id="region" class="tab-pane fade ">
                            <div class="header">
                                <h2>
                                    {{ $createItemNameregion }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNameregion.'.update') }}">

                                        {{ csrf_field() }}
                                        <input value="@if(!empty($regionedit)) {{ $regionedit->id }} @endif" name="regionid" type="hidden" >
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input name="regionName" type="text" class="form-control" value="@if(!empty($regionedit)){{ $regionedit->name }}@endif">
                                                        <label class="form-label">Region</label>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        {{ (!empty($regionedit)) ? "Update" : "Add New" }}
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>


                                <div>
                                    <!-- <form enctype="multipart/form-data" class="form" id="form_validation" method="post" action="{{ route($ParentRouteNamesupportDonor.'.update') }}"> -->
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Region</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            

                                        <?php $i = 1; ?>
                                        @if(count($region)>0)
                                            @foreach($region as $regionone)
                                                    
                                            <tr>
                                                <td> {{ $regionone->id }}</td>
                                                <td>{{ $regionone->name }} </td>
                                                <td class="tdTrashAction">
                                                    <a class="btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteNameregion.'.edit',['id'=>$regionone->id]) }}/#region" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="material-icons">mode_edit</i></a>

                                                    <a 
                                                        class="btn btn-xs btn-danger waves-effect" onclick="return confirm('Do you want to Delete?');"
                                                       href="{{ route($ParentRouteNameregion.'.destroy',['id'=>$regionone->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Delete"> <i
                                                                class="material-icons">delete</i></a>


                                                </td>
                                            </tr>
                                        <?php $i++; ?>
                                            @endforeach
                                        @endif
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Region</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>
                                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    Update
                                                </button>
                                            </div>
                                        </div> -->
                                        <!-- </form> -->
                                </div>

                            </div>
                        </div>

                        <!-- Region setting end -->

                        <!-- Cost type setting start -->

                        <div id="costType" class="tab-pane fade ">
                            <div class="header">
                                <h2>
                                    {{ $createItemNamecostType  }}
                                </h2>
                                <br>
                                <div class="body">
                                    <form enctype="multipart/form-data" class="form" id="form_validation" method="post"
                                          action="{{ route($ParentRouteNamecostType.'.update') }}">

                                        {{ csrf_field() }}
                                        <input value="@if(!empty($costTypeedit)) {{ $costTypeedit->id }} @endif" name="costType_id" type="hidden" >
                                        <div class="row clearfix">

                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input value="@if(!empty($costTypeedit)){{ $costTypeedit->name }}@endif" name="costType" type="text"
                                                               class="form-control">
                                                        <label class="form-label">Cost Type</label>
                                                    </div>
                                                </div>
                                            </div>
      
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-line">                     
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                        {{ (!empty($costTypeedit)) ? "Update" : "Add New" }}
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>


                                <div>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $i = 1; ?>
                                        @if(!empty($costType))
                                            @foreach($costType as $costTypeone)
                                                    
                                            <tr>
                                                <td>{{ $costTypeone->id }}</td>
                                                <td>{{ $costTypeone->name }}</td>
                                                <td class="tdTrashAction">
                                                    <a class="btn btn-xs btn-info waves-effect"
                                                       href="{{ route($ParentRouteNamecostType.'.edit',['id'=>$costTypeone->id]) }}/#costType" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="material-icons">mode_edit</i></a>      

                                                    <a 
                                                        class="btn btn-xs btn-danger waves-effect" onclick="return confirm('Do you want to Delete?');"
                                                       href="{{ route($ParentRouteNamecostType.'.destroy',['id'=>$costTypeone->id]) }}"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Delete"> <i
                                                                class="material-icons">delete</i></a>


                                                </td>
                                            </tr>
                                        <?php $i++; ?>
                                            @endforeach
                                        @endif
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                        <!-- Cost type setting end -->



                    </div>

                    </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
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

        // function quarter1(month)
        // {

        //     var Quarter1_Start = $("#Quarter1_Start").val();
        //     // alert(month);
        //     // alert(Quarter1_Start); return false;

        //     if(month == Quarter1_Start){
        //         alert("This month already selected"); return false;
        //     }



        //     // var a = month;
        //     // alert(a); return false;
            
        //     // var list  =  [
        //     //    "January",
        //     //    "February",
        //     //    "March",
        //     //    "April",
        //     //    "May",
        //     //    "June",
        //     //    "July",
        //     //    "August",
        //     //    "Septmber",
        //     //    "October",
        //     //    "November",
        //     //    "December",
        //     // ];

        //     // console.log(list); return false;

        //     // $("#Quarter2_Start option[value='"+month+"']").attr("disabled","disabled");
        //     $(list).addClass('disabled').children('a').attr('href', '#').attr('tabindex', -1);
        //     // $("#Quarter1_End option[value='"+month+"']").prop('removed',true);
        //     // $("#Quarter1_End option[value='"+month+"']").attr("disabled","disabled");

            
        // }

        var lastmonth1_Start = $("#Quarter1_Start").val();
        $('#Quarter1_Start').on('change', function() {
          // alert( this.value );
          var month = this.value;          
          var Quarter1_End = $("#Quarter1_End").val();
          var Quarter2_Start = $("#Quarter2_Start").val();
          var Quarter2_End = $("#Quarter2_End").val();
          var Quarter3_Start = $("#Quarter3_Start").val();
          var Quarter3_End = $("#Quarter3_End").val();
          var Quarter4_Start = $("#Quarter4_Start").val();
          var Quarter4_End = $("#Quarter4_End").val();
          
          if(month == Quarter1_End){
                alert("This month already selected"); 
                $("#Quarter1_Start").val(lastmonth1_Start); 
                return false;
            }

            if(month == Quarter2_Start){
                alert("This month already selected");
                $("#Quarter1_Start").val(lastmonth1_Start);
                return false;
            }

            if(month == Quarter2_End){
                alert("This month already selected");
                $("#Quarter1_Start").val(lastmonth1_Start);
                return false;
            }

            if(month == Quarter3_Start){
                alert("This month already selected");
                $("#Quarter1_Start").val(lastmonth1_Start);
                return false;
            }

            if(month == Quarter3_End){
                alert("This month already selected");
                $("#Quarter1_Start").val(lastmonth1_Start);
                return false;
            }

            if(month == Quarter4_Start){
                alert("This month already selected");
                $("#Quarter1_Start").val(lastmonth1_Start);
                return false;
            }

            if(month == Quarter4_End){
                alert("This month already selected");
                $("#Quarter1_Start").val(lastmonth1_Start);
                return false;
            }

        });

        var lastmonth1_End = $("#Quarter1_End").val();
        $('#Quarter1_End').on('change', function() {
          // alert( this.value );
          var month = this.value;
          var Quarter1_Start = $("#Quarter1_Start").val();
          var Quarter2_Start = $("#Quarter2_Start").val();
          var Quarter2_End = $("#Quarter2_End").val();
          var Quarter3_Start = $("#Quarter3_Start").val();
          var Quarter3_End = $("#Quarter3_End").val();
          var Quarter4_Start = $("#Quarter4_Start").val();
          var Quarter4_End = $("#Quarter4_End").val();
          
          if(month == Quarter1_Start){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth1_End);
                return false;
            }

            if(month == Quarter2_Start){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth1_End);
                return false;
            }

            if(month == Quarter2_End){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth1_End);
                return false;
            }

            if(month == Quarter3_Start){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth1_End);
                return false;
            }

            if(month == Quarter3_End){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth1_End);
                return false;
            }

            if(month == Quarter4_Start){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth1_End);
                return false;
            }

            if(month == Quarter4_End){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth1_End);
                return false;
            }

        });

        var lastmonth2_Start = $("#Quarter2_Start").val();
        $('#Quarter2_Start').on('change', function() {
          // alert( this.value );
          var month = this.value;
          var Quarter1_Start = $("#Quarter1_Start").val();
          var Quarter1_End = $("#Quarter1_End").val();
          var Quarter2_End = $("#Quarter2_End").val();
          var Quarter3_Start = $("#Quarter3_Start").val();
          var Quarter3_End = $("#Quarter3_End").val();
          var Quarter4_Start = $("#Quarter4_Start").val();
          var Quarter4_End = $("#Quarter4_End").val();
          
            if(month == Quarter1_Start){
                alert("This month already selected");
                $("#Quarter2_Start").val(lastmonth2_Start);
                return false;
            }

            if(month == Quarter1_End){
                alert("This month already selected");
                $("#Quarter2_Start").val(lastmonth2_Start);
                return false;
            }

            if(month == Quarter2_End){
                alert("This month already selected");
                $("#Quarter2_Start").val(lastmonth2_Start);
                return false;
            }

            if(month == Quarter3_Start){
                alert("This month already selected");
                $("#Quarter2_Start").val(lastmonth2_Start);
                return false;
            }

            if(month == Quarter3_End){
                alert("This month already selected");
                $("#Quarter2_Start").val(lastmonth2_Start);
                return false;
            }

            if(month == Quarter4_Start){
                alert("This month already selected");
                $("#Quarter2_Start").val(lastmonth2_Start);
                return false;
            }

            if(month == Quarter4_End){
                alert("This month already selected");
                $("#Quarter2_Start").val(lastmonth2_Start);
                return false;
            }
            
        });

        var lastmonth2_End = $("#Quarter2_End").val();
        $('#Quarter2_End').on('change', function() {
          // alert( this.value );
          var month = this.value;
          var Quarter1_Start = $("#Quarter1_Start").val();
          var Quarter1_End = $("#Quarter1_End").val();
          var Quarter2_Start = $("#Quarter2_Start").val();
          var Quarter3_Start = $("#Quarter3_Start").val();
          var Quarter3_End = $("#Quarter3_End").val();
          var Quarter4_Start = $("#Quarter4_Start").val();
          var Quarter4_End = $("#Quarter4_End").val();
          
          if(month == Quarter1_Start){
                alert("This month already selected");
                $("#Quarter2_End").val(lastmonth2_End);
                return false;
            }

            if(month == Quarter1_End){
                alert("This month already selected");
                $("#Quarter2_End").val(lastmonth2_End);
                return false;
            }

            if(month == Quarter2_Start){
                alert("This month already selected");
                $("#Quarter2_End").val(lastmonth2_End);
                return false;
            }

            if(month == Quarter3_Start){
                alert("This month already selected");
                $("#Quarter2_End").val(lastmonth2_End);
                return false;
            }

            if(month == Quarter3_End){
                alert("This month already selected");
                $("#Quarter2_End").val(lastmonth2_End);
                return false;
            }

            if(month == Quarter4_Start){
                alert("This month already selected");
                $("#Quarter2_End").val(lastmonth2_End);
                return false;
            }

            if(month == Quarter4_End){
                alert("This month already selected");
                $("#Quarter2_End").val(lastmonth2_End);
                return false;
            }
        });

        var lastmonth3_Start = $("#Quarter3_Start").val();
        $('#Quarter3_Start').on('change', function() {
          // alert( this.value );
          var month = this.value;
          var Quarter1_Start = $("#Quarter1_Start").val();
          var Quarter1_End = $("#Quarter1_End").val();
          var Quarter2_Start = $("#Quarter2_Start").val();
          var Quarter2_End = $("#Quarter2_End").val();
          var Quarter3_End = $("#Quarter3_End").val();
          var Quarter4_Start = $("#Quarter4_Start").val();
          var Quarter4_End = $("#Quarter4_End").val();
          
          if(month == Quarter1_Start){
                alert("This month already selected");
                $("#Quarter3_Start").val(lastmonth3_Start);
                return false;
            }

            if(month == Quarter1_End){
                alert("This month already selected");
                $("#Quarter3_Start").val(lastmonth3_Start);
                return false;
            }

            if(month == Quarter2_Start){
                alert("This month already selected");
                $("#Quarter3_Start").val(lastmonth3_Start);
                return false;
            }

            if(month == Quarter2_End){
                alert("This month already selected");
                $("#Quarter3_Start").val(lastmonth3_Start);
                return false;
            }

            if(month == Quarter3_End){
                alert("This month already selected");
                $("#Quarter3_Start").val(lastmonth3_Start);
                return false;
            }

            if(month == Quarter4_Start){
                alert("This month already selected");
                $("#Quarter3_Start").val(lastmonth3_Start);
                return false;
            }

            if(month == Quarter4_End){
                alert("This month already selected");
                $("#Quarter3_Start").val(lastmonth3_Start);
                return false;
            }
        });

        var lastmonth3_End = $("#Quarter3_End").val();
        $('#Quarter3_End').on('change', function() {
          // alert( this.value );
          var month = this.value;
          var Quarter1_Start = $("#Quarter1_Start").val();
          var Quarter1_End = $("#Quarter1_End").val();
          var Quarter2_Start = $("#Quarter2_Start").val();
          var Quarter2_End = $("#Quarter2_End").val();
          var Quarter3_start = $("#Quarter3_start").val();
          var Quarter4_Start = $("#Quarter4_Start").val();
          var Quarter4_End = $("#Quarter4_End").val();
          
          if(month == Quarter1_Start){
                alert("This month already selected");
                $("#Quarter3_End").val(lastmonth3_End);
                return false;
            }

            if(month == Quarter1_End){
                alert("This month already selected");
                $("#Quarter3_End").val(lastmonth3_End);
                return false;
            }

            if(month == Quarter2_Start){
                alert("This month already selected");
                $("#Quarter3_End").val(lastmonth3_End);
                return false;
            }

            if(month == Quarter2_End){
                alert("This month already selected");
                $("#Quarter3_End").val(lastmonth3_End);
                return false;
            }

            if(month == Quarter3_start){
                alert("This month already selected");
                $("#Quarter3_End").val(lastmonth3_End);
                return false;
            }

            if(month == Quarter4_Start){
                alert("This month already selected");
                $("#Quarter3_End").val(lastmonth3_End);
                return false;
            }

            if(month == Quarter4_End){
                alert("This month already selected");
                $("#Quarter3_End").val(lastmonth3_End);
                return false;
            }
        });

        var lastmonth4_Start = $("#Quarter4_Start").val();
        $('#Quarter4_Start').on('change', function() {
          // alert( this.value );
          var month = this.value;
          var Quarter1_Start = $("#Quarter1_Start").val();
          var Quarter1_End = $("#Quarter1_End").val();
          var Quarter2_Start = $("#Quarter2_Start").val();
          var Quarter2_End = $("#Quarter2_End").val();
          var Quarter3_start = $("#Quarter3_start").val();
          var Quarter3_End = $("#Quarter3_End").val();
          var Quarter4_End = $("#Quarter4_End").val();
          
          if(month == Quarter1_Start){
                alert("This month already selected");
                $("#Quarter4_Start").val(lastmonth4_Start);
                return false;
            }

            if(month == Quarter1_End){
                alert("This month already selected");
                $("#Quarter4_Start").val(lastmonth4_Start);
                return false;
            }

            if(month == Quarter2_Start){
                alert("This month already selected");
                $("#Quarter4_Start").val(lastmonth4_Start);
                return false;
            }

            if(month == Quarter2_End){
                alert("This month already selected");
                $("#Quarter4_Start").val(lastmonth4_Start);
                return false;
            }

            if(month == Quarter3_start){
                alert("This month already selected");
                $("#Quarter4_Start").val(lastmonth4_Start);
                return false;
            }

            if(month == Quarter3_End){
                alert("This month already selected");
                $("#Quarter4_Start").val(lastmonth4_Start);
                return false;
            }

            if(month == Quarter4_End){
                alert("This month already selected");
                $("#Quarter4_Start").val(lastmonth4_Start);
                return false;
            }
        });

        var lastmonth4_End = $("#Quarter4_End").val();
        $('#Quarter4_End').on('change', function() {
          // alert( this.value );
          var month = this.value;
          var Quarter1_Start = $("#Quarter1_Start").val();
          var Quarter1_End = $("#Quarter1_End").val();
          var Quarter2_Start = $("#Quarter2_Start").val();
          var Quarter2_End = $("#Quarter2_End").val();
          var Quarter3_start = $("#Quarter3_start").val();
          var Quarter3_End = $("#Quarter3_End").val();
          var Quarter4_start = $("#Quarter4_start").val();
          
          if(month == Quarter1_Start){
                alert("This month already selected");
                $("#Quarter4_End").val(lastmonth4_End);
                return false;
            }

            if(month == Quarter1_End){
                alert("This month already selected");
                $("#Quarter4_End").val(lastmonth4_End);
                return false;
            }

            if(month == Quarter2_Start){
                alert("This month already selected");
                $("#Quarter4_End").val(lastmonth4_End);
                return false;
            }

            if(month == Quarter2_End){
                alert("This month already selected");
                $("#Quarter4_End").val(lastmonth4_End);
                return false;
            }

            if(month == Quarter3_start){
                alert("This month already selected");
                $("#Quarter4_End").val(lastmonth4_End);
                return false;
            }

            if(month == Quarter3_End){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth4_End);
                return false;
            }

            if(month == Quarter4_start){
                alert("This month already selected");
                $("#Quarter1_End").val(lastmonth4_End);
                return false;
            }
        });

        // $('#Quarter1_End').on('change', function() {
        //   // alert( this.value );
        //   var month = this.value;
        //   var Quarter1_Start = $("#Quarter1_Start").val();
        //   if(month == Quarter1_Start){
        //         alert("This month already selected"); return false;
        //     }
        // });

        // $('#Quarter1_End').on('change', function() {
        //   // alert( this.value );
        //   var month = this.value;
        //   var Quarter1_Start = $("#Quarter1_Start").val();
        //   if(month == Quarter1_Start){
        //         alert("This month already selected"); return false;
        //     }
        // });



        // $("#Quarter1_end").change(function(){
        //     alert("dsd"); return false;
        // });


        // $("#Quarter1_Start").change(function(){
        //     var id = $(this).val();
        //     // alert(id); return false;
            

        //     // alert (id); return false;
        // });


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


<script type="text/javascript">

</script>

<script type="text/javascript">
    $(document).ready(function() {
        // alert(location.hash); return false;
        if (location.hash) {
            $("a[href='" + location.hash + "']").tab("show");
        }
    });
</script>

@endpush
