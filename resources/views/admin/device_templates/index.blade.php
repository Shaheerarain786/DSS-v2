@extends('admin.layouts.master')
@section('pageTitle', 'All Categories')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active"><a href="{{url('device-templates')}}"> Device Templates</a></li>
@endsection

@section('content')
    <div id="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bordered">
                    {{--                    <div class="panel-heading">--}}
                    {{--                        <h3 class="panel-title">Manage Device Templates</h3>--}}
                    {{--                    </div>--}}
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
                    <div class="panel-body">
                        <a class="btn btn-primary btn-rounded" href="{{url('device-templates/show')}}">
                            Create &nbsp;&nbsp;
                            <i class="fa fa-plus"></i>
                        </a>
                        <div class="panel">
                            <div class="panel-body">
                                <table id="deviceTables" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Template Image</th>
                                        <th class="width-images">Images</th>
                                        <th class="width-videos">Videos</th>
                                        <th>Logo</th>
                                        <th>Ticker</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($templates as $key => $temp)
                                        <tr>
                                            <td>{{$key +  1}}</td>
                                            <td><img
                                                    src="{{url('/') . "/" . $temp['device_templates']->template_images}}"
                                                    height="50"></td>
                                            <td class="width-images">
                                                @if($temp->device_templates->images_required == 0)
                                                    <div class="well well-sm bg-danger">NO template images</div>
                                                @else
                                                    <button data-toggle="modal"
                                                            data-target="#images-model-{{$temp->id}}"
                                                            class="btn btn-dark btn-sm btn-circle"><i
                                                            class="fa fa-image"></i></button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($temp->device_templates->videos_required == 0)
                                                    <div class="well well-sm bg-danger">NO Template Videos </div>
                                                @else
                                                    <button data-toggle="modal"
                                                            data-target="#videos-model-{{$temp->id}}"
                                                            class="btn btn-dark btn-sm btn-circle"><i
                                                            class="fa fa-video"></i></button>
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{url('/') . $temp->logo}}" height="50">
                                            </td>
                                            <td class="text-style">
                                                {{$temp->ticker_text}}
                                            </td>
{{--                                            <td>--}}
{{--                                                <a class="btn btn-primary btn-sm btn-circle"--}}
{{--                                                   href="{{url('device-templates/edit/'. $temp->id)}}"><i--}}
{{--                                                        class="fas fa-edit"></i></a>--}}
{{--                                            </td>--}}

                                            <td><a class="btn btn-danger btn-sm btn-circle" data-toggle="modal"
                                                   data-target="#delete-{{$temp->id}}"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.device_templates.modals.images-model')
                    @include('admin.device_templates.modals.videos-model')
                    @include('admin.device_templates.modals.delete')
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#deviceTables").DataTable({
        });
    })
</script>
