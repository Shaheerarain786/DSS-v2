@extends('admin.layouts.master')
@section('pageTitle', 'Scheduling')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active"><a href="{{url('schedule')}}"> Scheduling</a></li>
@endsection
@section('content')
    <style>
        #zonesDropDown {
            width: 100% !important;
        }

        #citiesDropDown, #branchesDropDown, #deviceGroupsDropDown, #orientationDropDown, #devicesDropDown, #deviceTemplateDropDown {
            width: 100% !important;
            text-align: center;
        }
        #relationColumn{
            border-right: solid 4px rgb(235 235 235);
        }

        .select2-container {
            margin-bottom: 20px;
        }
    </style>
    <div id="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3" id="relationColumn">
                                <select name="zones" id="zonesDropDown">
                                    <option value=""></option>
                                    @foreach($zones as $zone)
                                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <select name="cities" id="citiesDropDown">
                                    <option value=""></option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <select name="branches" id="branchesDropDown">
                                    <option value=""></option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                                <select name="deviceGroups" id="deviceGroupsDropDown">
                                    <option value=""></option>
                                    @foreach($deviceGroups as $deviceGroup)
                                        <option value="{{$deviceGroup->id}}">{{$deviceGroup->name}}</option>
                                    @endforeach
                                </select>
                                <select name="orientation" id="orientationDropDown">
                                    <option value=""></option>
                                    <option value="portrait">Portrait</option>
                                    <option value="portrait">Landscape</option>
                                </select>
                                <select name="devices" id="devicesDropDown" multiple>
                                    <option value=""></option>
                                    @foreach($devices as $device)
                                        <option value="{{$device->id}}">{{$device->device_name}}</option>
                                    @endforeach
                                </select>
                                <select name="deviceTemplates" id="deviceTemplateDropDown" multiple>
                                    <option value=""></option>
                                    @foreach($deviceTemplateData as $deviceTemplate)
                                        <option value="{{$deviceTemplate->id}}">{{$deviceTemplate->device_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#zonesDropDown").select2({
            placeholder: "Select Zone",
            allowClear: true
        });
        $("#citiesDropDown").select2({
            placeholder: "Select City",
            allowClear: true
        });
        $("#branchesDropDown").select2({
            placeholder: "Select Branch",
            allowClear: true
        });
        $("#deviceGroupsDropDown").select2({
            placeholder: "Select Device Group",
            allowClear: true
        });
        $("#orientationDropDown").select2({
            placeholder: "Select Device Orientation",
            allowClear: true
        });
        $("#devicesDropDown").select2({
            placeholder: "Select Devices",
            allowClear: true
        });
    </script>
@endsection
