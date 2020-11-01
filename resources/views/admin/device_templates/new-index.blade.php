@extends('admin.layouts.master')
@section('pageTitle', 'All Categories')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active"><a href="{{url('device-templates')}}"> Device Templates</a></li>
@endsection
@section('content')
    <style>
        .container-template {
            box-shadow: 0px 0px 5px 0px lightgrey;
            padding: 20px;
        }
        .select2-container {
            width: 100% !important;
        }
        input[type=radio] {
            width: 20px;
            height: 20px;
            position: absolute;
            top: 67px;
            left: 33px;
        }
    </style>
    <div id="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Manage Device Templates</h3>
                    </div>
                    <div class="panel-body" id="main-panel">
                        <div class="pull-right">
                            <span class="label label-default">Video</span>
                            <span class="label label-warning">Ticker</span>
                            <span class="label label-success">Que Numbers</span>
                            <span class="label label-primary">Image</span>
                            <span class="label label-danger">Logo</span>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>

                        @if($deviceTemplates->count() > 0)
                            <div class="row" style="text-align: center">
                                @foreach($deviceTemplates->chunk(4) as $templates)
                                    @foreach($templates as $temp)
                                        <div class="col-md-3">
                                            <div class="form-group container-template">
                                                <input data-template_id="{{$temp->id}}" data-images_required="{{$temp->images_required}}" data-videos_required="{{$temp->videos_required}}" data-ppt_required="{{$temp->ppt_required}}" type="radio" id="{{$temp->name}}" name="temp"
                                                       value="{{$temp->name}}"/>
                                                <label for="{{$temp->name}}"><img
                                                        src="{{url('/') . '/' . $temp->template_images}}"/></label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <button id="nextBtn" class="btn btn-primary pull-right"><i
                                    class="fa fa-arrow-right"></i>&nbsp;&nbsp;Next
                            </button>
                        @endif
                    </div>


                    @include('admin.device_templates.modals.template1')
                    @include('admin.device_templates.modals.error')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $("#branchName").select2({
                'placeholder': 'Select Devices',
                dropdownParent: $("#tenmplate1")
            });
            $("#display_type").select2({
                dropdownParent: $("#tenmplate1"),
                'placeholder': 'Select Schedule or Urgent'
            });

            $("#nextBtn").click(function () {
                var radio_value = $("input[name='temp']:checked").val();
                if (radio_value == undefined || radio_value == '' || radio_value <= 0) {
                    $("#errorMessage").text("Please Select At least 1 Template");
                    $("#errorModal").modal().show();
                    return;
                }
                else{
                    var video_required = $("input[name=temp]:checked").attr('data-videos_required');
                    var images_required = $("input[name=temp]:checked").attr('data-images_required');
                    var ppt_required = $("input[name=temp]:checked").attr('data-ppt_required');
                    var template_id = $("input[name=temp]:checked").attr('data-template_id');

                    $.ajax({
                        type: "POST",
                        url: "{{url('/ajax-next-device-template-setting')}}",
                        data : {
                            video_count : video_required,
                            images_count: images_required,
                            ppt_count: ppt_required,
                            template_id : template_id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            var html = response.html;
                            $("#main-panel").empty();
                            $("#main-panel").html(html);
                        }
                    })
                }
            });

            $("#datetimepickerTo").datetimepicker({
                sideBySide: true,
            });
            $("#datetimepickerFrom").datetimepicker({
                sideBySide: true,
            });
            //
        })
    </script>
@endsection
