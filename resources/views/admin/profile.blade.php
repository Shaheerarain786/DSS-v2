@extends('admin.layouts.master')
@section('pageTitle', 'Profile')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active">Profile</li>
@endsection
@section('content')
    <div id="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Manage Profile</h3>
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
                    <div class="panel-body">
                        @if(session()->has("success"))
                            <div class="alert alert-success">
                                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                                <stong>{{session()->get("success")}}</stong>
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" autocomplete="off" action="{{route('update-profile')}}">
                            @csrf
                            @method('PUT')
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">Your
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input id="orgName" type="text" name="name" placeholder="Your Name"
                                               class="form-control" value="{{old('name', $profileData->name)}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" placeholder="Email"
                                               class="form-control" value="{{old('email', $profileData->email)}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" placeholder="Password"
                                               class="form-control" value="{{old('password')}}">
                                    </div>
                                </div>

                                <div class="panel-footer text-right">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
