@extends('admin.layouts.master')
@section('pageTitle', 'All Categories')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active"><a href="{{url('branches')}}"> Relations</a></li>
@endsection
@section('content')
    <style>
        ul {
            text-align: left !important;
        }

        .checkBoxDiv {
            width: 10px;
        }

        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            width: 100% !important;
            text-align: left;
        }

        #overlay {
            position: fixed;
            z-index: 99999;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(255, 255, 255, 255);
            transition: 1s 0.4s;
        }

        #overlay img {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 0;
            right: 0;
            margin: 0 auto;
        }
    </style>
    {{--    <div id="overlay">--}}
    {{--        <img src="{{asset('admin-assets/img/2D-HN.gif')}}" height="100" alt="Loading" />--}}
    {{--    </div>--}}
    <div id="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Manage Relations</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has("success"))
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                            <stong>{{session()->get("success")}}</stong>
                        </div>
                    @endif
                    <div class="panel">
                        <div class="panel-body">
                            <table id="branches" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Zones</th>
                                    <th>Cities</th>
                                    <th>Branches</th>
                                    <th>Device Group</th>
                                    <th>Devices</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($zones as $zone)
                                    <tr>
                                        <td>{{$zone->name}}</td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach($zone->cities as $city)
                                                    <li style="text-align: center;color: black"
                                                        class="list-group-item">{{$city->name}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach($zone->cities as $city)
                                                    <li style="color: black" class="list-group-item">
                                                        <strong style="padding:5px"
                                                                class="bg-dark">{{$city->name}}</strong>
                                                        <ul class="list-group">
                                                            @foreach($city->branches as $branch)
                                                                <li style="text-align: center;color: black"
                                                                    class="list-group-item">{{$branch->branch_name}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach($zone->cities as $city)
                                                    @foreach($city->branches as $branch)
                                                        <li class="list-group-item">
                                                            <strong style="padding: 5px"
                                                                    class="bg-dark">{{$branch->branch_name}}</strong>
                                                            <ul class="list-group">
                                                                @foreach($branch->device_group as $dg)
                                                                    <li class="list-group-item"
                                                                        style="text-align: center;color:black">
                                                                        {{$dg->name}}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach($zone->cities as $city)
                                                    @foreach($city->branches as $branch)
                                                        @foreach($branch->device_group as $dg)
                                                            <li class="list-group-item">
                                                                <strong style="padding: 5px"
                                                                        class="bg-dark">{{$dg->name}}</strong>
                                                                <ul class="list-group">
                                                                    @foreach($dg->devices as $device)
                                                                        <li class="list-group-item"
                                                                            style="text-align: center;color:black">
                                                                            {{$device->device_name}}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </td>
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
@endsection
@section('js')
    <script src="{{asset('admin-assets/scripts/zones.js')}}"></script>
@endsection
