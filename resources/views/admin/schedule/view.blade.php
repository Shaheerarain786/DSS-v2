@extends('admin.layouts.master')
@section('pageTitle', 'Scheduling')
@section('breadcrumb')
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i></a></li>
    <li><a href="{{url('/')}}">Dashboard</a></li>
    <li class="active"><a href="{{url('schedule')}}"> Scheduling</a></li>
@endsection
@section('content')

    <style>
        

        #zonesDropDownFillter, #citiesDropDownFillter, #branchesDropDownFillter, #deviceGroupsDropDownFillter {
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
                               
                                 <div class="col-sm-12">
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
                                        <th>Actions</th>
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
        $("#zonesDropDownFillter").select2({
            placeholder: "Select Zone",
            allowClear: true
        });
        $("#citiesDropDownFillter").select2({
            placeholder: "Select City",
            allowClear: true
        });
        $("#branchesDropDownFillter").select2({
            placeholder: "Select Branch",
            allowClear: true
        });
        $("#deviceGroupsDropDownFillter").select2({
            placeholder: "Select Device Group",
            allowClear: true
        });
        
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
                    { data: 'edit', name: 'edit' },
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
