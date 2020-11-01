@extends('admin.layouts.master')
@section('pageTitle', 'All Categories')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active"><a href="{{url('branches')}}"> Users</a></li>
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
                        <h3 class="panel-title">Manage Users</h3>
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
                    {{--                    <div id="message" class="alert alert-success">--}}
                    {{--                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>--}}
                    {{--                        <strong></strong>--}}
                    {{--                    </div>--}}
                    <div class="panel-body">
                        @if(auth()->user()->is_super == true)
                        <button data-toggle="modal" data-target="#addUser" class="btn btn-primary btn-rounded"><i
                                class="fa fa-plus"></i> &nbsp;&nbsp;Add
                        </button>
                        @endif
                        <div class="panel">
                            <div class="panel-body">
                                <table id="branches" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        @if($authId == true)
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($get_all_users as $key => $user)
                                        <tr>
                                            <td style="width: 40px">{{$key +  1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->is_super == false ? "User" : "Super Admin"}}</td>
                                            @if($authId == true)
                                                <td>
                                                    <a class="btn btn-primary btn-sm btn-circle"
                                                       href="{{url('users/'. $user->id . '/edit')}}"><i
                                                            class="fas fa-edit"></i></a>
                                                </td>
                                                <td>
                                                    @if(auth()->user()->id != $user->id)
                                                        <button class="btn btn-danger btn-sm btn-circle"
                                                                data-toggle="modal"
                                                                data-target="#{{$user->id}}"><i
                                                                class="fas fa-trash"></i>
                                                        </button>
                                                    @else
                                                        <button disabled="disabled" class="btn btn-danger btn-sm btn-circle"><i
                                                                class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                                        @include('admin.users.modals.add')
                    {{--                    @include('admin.zones.modals.assign')--}}
                                        @include('admin.users.modals.delete')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {{--    <script src="{{asset('admin-assets/scripts/zones.js')}}"></script>--}}
@endsection
