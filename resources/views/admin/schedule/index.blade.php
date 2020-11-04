@extends('admin.layouts.master')
@section('pageTitle', 'Scheduling')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active"><a href="{{url('schedule')}}"> Scheduling</a></li>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('admin-assets/plugins/datetime/dist/daterangepicker.min.css')}}">
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
                                <form action="{{route('set_schedule')}}" method="post" autocomplete="off">
                                    @csrf
                                <select name="zone" id="zonesDropDown" required="">
                                    <option value=""></option>
                                    @foreach($zones as $zone)
                                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <select name="city" id="citiesDropDown" disabled>
                                    
                                    
                                </select>
                                <br>
                                <select name="branch" id="branchesDropDown" disabled>
                                    
                                </select>
                                <select name="deviceGroup" id="deviceGroupsDropDown" disabled>
                                    <option value=""></option>
                                    
                                </select>
                                <select name="orientation" id="orientationDropDown" required="" >
                                    <option value=""></option>
                                    <option value="portrait">Portrait</option>
                                    <option value="landscape">Landscape</option>
                                </select>
                                <select name="devices[]" id="devicesDropDown" multiple required="">
                                    <option value=""></option>
                                    
                                </select>
                                
                                <select id="deviceTemplates" name="deviceTemplate" style="width: 100%;" required="">
                                    <option value=""></option>
                                    @foreach($deviceTemplateData as $deviceTemplate)
                                        <option value="{{$deviceTemplate->id}}" title="{{$deviceTemplate->device_templates->template_images}}">{{$deviceTemplate->ticker_text}}</option>
                                    @endforeach
                                </select>

                                <div class="form-group">
                                    <input type="" name="datetime" placeholder="select datetime range" id="domid" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary"style="width: 100%;" type="submit">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('admin-assets/plugins/datetime/dist/jquery.daterangepicker.min.js')}}"></script>
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
        
        $("#zonesDropDown").change(function(){
            var zone_id = $(this).val();
            if(zone_id){
                var url= "{{Route('get_cities', "zone_id")}}";
                $.ajax({
                        url:url.replace('zone_id', zone_id),
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            $('#citiesDropDown').empty();
                            $('#branchesDropDown').empty().attr('disabled', true);
                            $('#deviceGroupsDropDown').empty().attr('disabled', true);
                            $('#orientationDropDown').val("-1").trigger("change");
                            $('#devicesDropDown').empty();

                            $('#citiesDropDown').removeAttr('disabled');
                            $('#citiesDropDown').append('<option value=""></option>');
                            $.each(data, function(key,value){
                               $('#citiesDropDown').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                });
            }
        });
        $("#citiesDropDown").change(function(){
            var city_id = $(this).val();
            if(city_id){
                var url= "{{Route('get_brances', "city_id")}}";
                $.ajax({
                    url:url.replace('city_id', city_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#branchesDropDown').empty();
                        $('#deviceGroupsDropDown').empty().attr('disabled', true);
                        $('#orientationDropDown').val("-1").trigger("change");
                        $('#devicesDropDown').empty();
                        $('#branchesDropDown').removeAttr('disabled');
                        $('#branchesDropDown').append('<option value=""></option>');
                        
                        $.each(data, function(key,value){
                           $('#branchesDropDown').append('<option value="'+ value.id +'">'+ value.branch_name +'</option>');

                        });
                    }
                });
            }
        });
        $("#branchesDropDown").change(function(){
            var branch_id = $(this).val();
            if(branch_id){
                var url= "{{Route('get_device_groups', "branch_id")}}";
                $.ajax({
                    url:url.replace('branch_id', branch_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#deviceGroupsDropDown').empty();
                        $('#devicesDropDown').empty();
                         $('#orientationDropDown').val("-1").trigger("change");
                        $('#deviceGroupsDropDown').removeAttr('disabled');
                        $('#deviceGroupsDropDown').append('<option value=""></option>');
                        
                        $.each(data, function(key,value){
                           $('#deviceGroupsDropDown').append('<option value="'+ value.id +'">'+ value.name +'</option>');

                        });
                    }
                });
            }
        });
        $("#orientationDropDown").change(function(){
            
            var orientation = $(this).val();
            var zone_id = $("#zonesDropDown").val();
            var city_id = $("#citiesDropDown").val();
            var branch_id =$("#branchesDropDown").val();
            var deviceGroup_id =$("#deviceGroupsDropDown").val();
            if(orientation){
                $.ajax({
                    url:"{{Route('get_devices')}}",
                    type: "GET",
                    dataType: "json",
                    data: { 
                    orientation: orientation, 
                    deviceGroup_id:deviceGroup_id,
                    zone_id: zone_id,
                    city_id:city_id,
                    branch_id:branch_id,
                    deviceGroup_id:deviceGroup_id,
                  },
                    success:function(data){
                        $('#devicesDropDown').empty();
                        $('#devicesDropDown').empty();
                        $('#devicesDropDown').append('<option value=""></option>');
                        
                        $.each(data, function(key,value){
                           $('#devicesDropDown').append('<option value="'+ value.id +'">'+ value.device_name +'</option>');

                        });
                    }
                });
            }
        });
    
    $("#deviceTemplates").select2({
        placeholder: "Select Device Template",
        allowClear: true,
        templateResult: function (idioma) {
            if(idioma.id>0){
                var $span = $("<span><img width='50' height='50' src='"+idioma.title+"'/>  "+idioma.text+" </span>");
                return $span;
            }
        },
        templateSelection: function (idioma) {
           if(idioma.id>0){
                var $span = $("<span>" + "<img  style='width: 37px;\n" +
                    "    height: 24px;\n" +
                    "    border-radius: 3px;' src='"+idioma.title+"'/></span>");
                return $span;
           }else{
            return "Select Device Template";
           }
        }
    });
    var configObject = {startOfWeek: 'monday',
        separator : ' ~ ',
        format: 'DD.MM.YYYY HH:mm',
        autoClose: false,
        time: {
            enabled: true
        }};
    $('#domid').dateRangePicker(configObject);
</script>


@endsection
