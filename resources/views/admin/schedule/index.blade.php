@extends('admin.layouts.master')
@section('pageTitle', 'Scheduling')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active"><a href="{{url('schedule')}}"> Scheduling</a></li>
@endsection
@section('content')

    <style>
        #zonesDropDown, #zonesDropDownFillter {
            width: 100% !important;
        }

        #citiesDropDown, #citiesDropDownFillter,#branchesDropDown, #branchesDropDownFillter, #deviceGroupsDropDownFillter, #deviceGroupsDropDown, #orientationDropDown, #devicesDropDown, #deviceTemplateDropDown {
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
                                @if(session()->has("success"))
                                    <div class="alert alert-success">
                                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                                        <stong>{{session()->get("success")}}</stong>
                                    </div>
                                @endif
                                @if(session()->has("error"))
                                    <div class="alert alert-success">
                                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                                        <stong>{{session()->get("error")}}</stong>
                                    </div>
                                @endif
                                <form action="{{route('set_schedule')}}" method="post" autocomplete="off">
                                    @csrf
                                <select name="zone_id" id="zonesDropDown" required="">
                                    <option value=""></option>
                                    @foreach($zones as $zone)
                                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <select name="city_id" id="citiesDropDown" disabled>
                                    
                                    
                                </select>
                                <br>
                                <select name="branch_id" id="branchesDropDown" disabled>
                                    
                                </select>
                                <select name="deviceGroup_id" id="deviceGroupsDropDown" disabled>
                                    <option value=""></option>
                                    
                                </select>
                                <select name="orientation" id="orientationDropDown" required="" >
                                    <option value=""></option>
                                    <option value="portrait">Portrait</option>
                                    <option value="landscape">Landscape</option>
                                </select>
                                <select name="devices[]" id="devicesDropDown" multiple >
                                    <option value=""></option>
                                    
                                </select>
                                
                                <select id="deviceTemplates" required="" name="deviceTemplate" style="width: 100%;" >
                                    <option value=""></option>
                                    @foreach($deviceTemplateData as $deviceTemplate)
                                        <option value="{{$deviceTemplate->id}}" title="{{$deviceTemplate->device_templates->template_images}}">{{$deviceTemplate->ticker_text}}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <input type='text' class="form-control" id='start_time' name="start_time" required="" placeholder="Select Start date and time" />
                                </div>
                                <div class="form-group">
                                   
                                   <input type='text' class="form-control" id='end_time' placeholder="Select end date and time" name="end_time" required="" />
                                </div>
                                <div class="form-group">
                                    <input type='text' class="form-control" id='assetsDownloadTime' placeholder="Select assets download time" name="assets_download_time" required="" />
                                </div>

                                    <input type="submit" name="" class="btn btn-primary" style="width: 100%;" value="submit">

                                 </form>
                               </div>
                               
                                 <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <select  id="zonesDropDownFillter" >
                                                <option value=""></option>
                                                @foreach($zones as $zone)
                                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                                @endforeach
                                            </select>
                                
                                        </div>
                                        <div class="col-sm-3">
                                            <select  id="citiesDropDownFillter" disabled="" >
                                                
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select  id="branchesDropDownFillter" disabled >
                                            </select>
                                
                                        </div>
                                        <div class="col-sm-3">
                                            <select  id="deviceGroupsDropDownFillter" disabled>
                                            </select>
                                
                                        </div>
                                    </div>
                                    <table class="table table-bordered" id="schedules">
                                   <thead>
                                      <tr>
                                         <th>#</th>
                                        <th>City</th>
                                        <th>Branch Name</th>
                                        <th>Device Group</th>
                                        <th>Device</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Device Template</th>
                                      </tr>
                                   </thead>
                                </table>

                                 </div>
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
        $("#zonesDropDown, #zonesDropDownFillter").select2({
            placeholder: "Select Zone",
            allowClear: true
        });
        $("#citiesDropDown, #citiesDropDownFillter").select2({
            placeholder: "Select City",
            allowClear: true
        });
        $("#branchesDropDown, #branchesDropDownFillter").select2({
            placeholder: "Select Branch",
            allowClear: true
        });
        $("#deviceGroupsDropDown,#deviceGroupsDropDownFillter").select2({
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
    
</script>
<script type="text/javascript">
   $(function () {
       $('#start_time, #assetsDownloadTime').datetimepicker({
            format: 'DD-MM-YYYY HH:mm',
            sideBySide: true,
       });
       $('#end_time').datetimepicker({
           useCurrent: false,
           format: 'DD-MM-YYYY HH:mm',
           sideBySide: true,
        });
       $("#start_time").on("dp.change", function (e) {
           $('#end_time').data("DateTimePicker").minDate(e.date);
           $('#assetsDownloadTime').data("DateTimePicker").maxDate(e.date);
       });
       $("#end_time").on("dp.change", function (e) {
           $('#start_time').data("DateTimePicker").maxDate(e.date);
       });
   });
   
</script>
<script>
    var oTable =    $('#schedules').DataTable({
            processing: true,
            serverSide: true,
            searching: false, 
           scrollY: true,
            
           
           ajax: {
            url: '{{ url('schedule-devices') }}',
                data: function (d) {
                    d.zone_id           = $('#zonesDropDownFillter').val();
                    d.city_id           = $('#citiesDropDownFillter').val();
                    d.branch_id         = $('#branchesDropDownFillter').val();
                    d.device_group_id   = $('#deviceGroupsDropDownFillter').val();
                }
            },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'city_id', name: 'city_id' },
                    { data: 'branch_id', name: 'branch_id' },
                    { data: 'device_group_id', name: 'device_group_id' },
                    { data: 'device_id', name: 'device_id' },
                    { data: 'start_time', name: 'start_time' },
                    { data: 'end_time', name: 'end_time' },
                    { data: 'device_template', name: 'device_template' },
                 ]
        });
     
   $("#zonesDropDownFillter").change(function(){
        
        
        var zone_id = $(this).val();
            if(zone_id){
                var url= "{{Route('get_cities', "zone_id")}}";
                $.ajax({
                        url:url.replace('zone_id', zone_id),
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            $('#citiesDropDownFillter').empty().val('');
                            $('#branchesDropDownFillter').empty().attr('disabled', true).val('');
                            $('#deviceGroupsDropDownFillter').empty().attr('disabled', true).val('');
                            $('#citiesDropDownFillter').removeAttr('disabled');
                            $('#citiesDropDownFillter').append('<option value=""></option>');
                            oTable.draw();
                            $.each(data, function(key,value){
                               $('#citiesDropDownFillter').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                });
            }
            
   });
    $("#citiesDropDownFillter").change(function(){
       
            var city_id = $(this).val();
            if(city_id){
                var url= "{{Route('get_brances', "city_id")}}";
                $.ajax({
                    url:url.replace('city_id', city_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#branchesDropDownFillter').empty().val('');
                        $('#deviceGroupsDropDownFillter').empty().attr('disabled', true).val();
                        $('#branchesDropDownFillter').removeAttr('disabled');
                        $('#branchesDropDownFillter').append('<option value=""></option>');
                         oTable.draw();
                        $.each(data, function(key,value){
                           $('#branchesDropDownFillter').append('<option value="'+ value.id +'">'+ value.branch_name +'</option>');

                        });
                    }
                });
            }
        });
    $("#branchesDropDownFillter").change(function(){
            var branch_id = $(this).val();
            if(branch_id){
                var url= "{{Route('get_device_groups', "branch_id")}}";
                $.ajax({
                    url:url.replace('branch_id', branch_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#deviceGroupsDropDownFillter').empty().val('');
                        $('#deviceGroupsDropDownFillter').removeAttr('disabled');
                        $('#deviceGroupsDropDownFillter').append('<option value=""></option>');
                        oTable.draw();
                        $.each(data, function(key,value){
                           $('#deviceGroupsDropDownFillter').append('<option value="'+ value.id +'">'+ value.name +'</option>');

                        });
                    }
                });
            }
            
        });
     $("#deviceGroupsDropDownFillter").change(function(){
        oTable.draw();
     });
  </script>
@endsection
