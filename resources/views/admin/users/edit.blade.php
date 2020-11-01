@extends('admin.layouts.master')
@section('pageTitle', 'Edit Categories')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li><a href="{{url('branches')}}"> Users</a></li>
    <li class="active">Update</li>
@endsection
@section('content')
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
                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" action="{{url('users/' . $user->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">User
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input id="orgName" type="text" name="name" placeholder="User's Name"
                                               class="form-control" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" placeholder="Email"
                                               class="form-control" value="{{$user->email}}">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $("#orgName").select2({
                'placeholder': 'Select Organization'
            });
        })

    </script>
    {{--function onCategoryChange(id) {--}}

    {{--    var category_id = id.value;--}}
    {{--    $.ajax({--}}
    {{--        type:"GET",--}}
    {{--        url: '{{ route('get_sub_category') }}',--}}
    {{--        data: {id : category_id},--}}
    {{--        success:function (response) {--}}
    {{--            $('#sub_category').html('<option value="">Select SubCategory</option>');--}}
    {{--            response.forEach(element => {--}}
    {{--                var newOption = new Option(element.name , element.id ,true);--}}
    {{--            $('#sub_category').append(newOption).trigger('change')--}}
    {{--        })--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}

@endsection
