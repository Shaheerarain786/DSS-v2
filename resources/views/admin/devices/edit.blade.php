@extends('admin.layouts.master')
@section('pageTitle', 'Create Categories')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li><a href="{{url('devices')}}"> Devices</a></li>
    <li class="active">Edit</li>
@endsection
@section('content')
    <style>
        .select2-container{
            width: 100% !important;
        }
    </style>
    <div id="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading panel-primary panel-colorful">
                        <h3 class="panel-title">Manage Devices</h3>
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
                    <div class="panel-body panel-colorful">
                        <form class="form-horizontal" method="POST" action="{{url('devices/' . $devices->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Device Name</label>
                                    <div class="col-sm-5">
                                        <input required type="text" placeholder="Deive Name" id="demo-hor-inputemail"
                                               class="form-control" name="device_name"
                                               {{old('device_name')}} value="{{$devices->device_name}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Device Orientation</label>
                                    <div class="col-sm-5">
                                        <select name="device_orientation" id="device_orientation">
                                            <option value=""></option>
                                            <option @if($devices->device_orientation == "landscape") selected
                                                    @endif value="landscape">Landscape
                                            </option>
                                            <option @if($devices->device_orientation == "portrait") selected
                                                    @endif value="portrait">Portrait
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Device No</label>
                                    <div class="col-sm-5">
                                        <input type="text" placeholder="Deive No" id="demo-hor-inputemail"
                                               class="form-control" name="device_no"
                                               {{old('device_no')}} value="{{$devices->device_no}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Device IP</label>
                                    <div class="col-sm-5">
                                        <input required type="text" placeholder="Device IP" id="demo-hor-inputemail"
                                               class="form-control" name="device_ip"
                                               {{old('device_ip')}} value="{{$devices->device_ip}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Device Model</label>
                                    <div class="col-sm-5">
                                        <input type="text" placeholder="Device Model" id="demo-hor-inputemail"
                                               class="form-control" name="device_model"
                                               {{old('device_model')}} value="{{$devices->device_model}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Device Screen Height</label>
                                    <div class="col-sm-5">
                                        <input type="text" placeholder="Device Screen Height" id="demo-hor-inputemail"
                                               class="form-control" name="device_screen_height"
                                               {{old('device_screen_height')}} value="{{$devices->device_screen_height}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Device Screen Width</label>
                                    <div class="col-sm-5">
                                        <input type="text" placeholder="Device Screen Width" id="demo-hor-inputemail"
                                               class="form-control" name="device_screen_width"
                                               {{old('device_screen_width')}} value="{{$devices->device_screen_width}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Device Storage Memory</label>
                                    <div class="col-sm-5">
                                        <input type="text" placeholder="Device Storage Memory" id="demo-hor-inputemail"
                                               class="form-control" name="device_storage_memory"
                                               {{old('device_storage_memory')}} value="{{$devices->device_storage_memory}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label text-primary text-bold"
                                           for="demo-hor-inputemail">Screen Resolution</label>
                                    <div class="col-sm-5">
                                        <input type="text" placeholder="Screen Resolution" id="demo-hor-inputemail"
                                               class="form-control" name="screen_resolution"
                                               {{old('screen_resolution')}} value="{{$devices->screen_resolution}}">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button class="btn btn-primary" type="submit">Update Device</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function (e) {
           $("#device_orientation").select2({
               placeholder: "Select Device Orientation"
           })
        })
    </script>
@endsection

