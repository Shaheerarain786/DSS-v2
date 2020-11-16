@extends('admin.layouts.master')
@section('pageTitle', 'Dashboard')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
@endsection
@section('content')
    <div id="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dashboard</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="panel panel-info panel-colorful">
                                        <div class="pad-all text-center">

                                            <strong><p>Organizations</p></strong>
                                            <i style="font-size: 30px" class="fa fa-flag fa-1x"></i>
                                            <span style="font-size: 30px" class="text-1x text-thin">{{$organizations}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="panel panel-warning panel-colorful">
                                        <div class="pad-all text-center">

                                            <strong><p>Zones</p></strong>
                                            <i style="font-size: 30px"  class="fa fa-tablet-alt fa-1x"></i>
                                            <span style="font-size: 30px"  class="text-1x text-thin">{{$zones}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="panel panel-primary panel-colorful">
                                        <div class="pad-all text-center">

                                            <strong><p>Cities</p></strong>
                                            <i style="font-size: 30px"  class="fa fa-tablet-alt fa-1x"></i>
                                            <span style="font-size: 30px"  class="text-1x text-thin">{{$cities}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="panel panel-primary panel-colorful">
                                        <div class="pad-all text-center">

                                            <strong><p>Branches</p></strong>
                                            <i style="font-size: 30px"  class="fa fa-tablet-alt fa-1x"></i>
                                            <span style="font-size: 30px"  class="text-1x text-thin">{{$branches}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Logs</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Running Schedules</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th> #</th>
                                                    <th>City</th>
                                                    <th>Branch Name</th>
                                                    <th>Device Group</th>
                                                    <th>Device</th>
                                                    <th>Device Template</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                             @php
                                                $count = 0;
                                             @endphp
                                              @foreach($runningSchedules as $device)
                                                  @php
                                                      $count++;
                                                  @endphp
                                                <tr>
                                                    <td>{{$count}}</td>
                                                    <td>{{$device->city->name}}</td>
                                                    <td>{{$device->branch->branch_name}}</td>
                                                    <td>{{$device->deviceGroup->name}}</td>
                                                    <td>{{$device->device->device_name}}</td>
                                                    <td><img src="{{asset($device->deviceTemplateData->device_templates->template_images)}}" border="0" width="40" class="img-rounded" align="center" />
                                                    <br>{{$device->deviceTemplateData->ticker_text}}</td>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
