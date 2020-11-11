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
                                <form action="{{route('update_schedule', $scheduledDevice)}}" method="post" autocomplete="off">
                                    @csrf
                                
                                <br>
                                <div class="form-group">
                                    <input type="text" disabled="" class="form-control" value="{{$scheduledDevice->device->device_name}}" name="">
                                </div>
                                <select id="deviceTemplates" required="" name="deviceTemplate" style="width: 100%;" >
                                    <option value=""></option>
                                    @foreach($deviceTemplateData as $deviceTemplate)
                                        <option value="{{$deviceTemplate->id}}" title="{{$deviceTemplate->device_templates->template_images}}" {{$deviceTemplate->id==$scheduledDevice->device_template_data_id?"selected":'' }}>{{$deviceTemplate->ticker_text}}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <input type='text' class="form-control" id='datetimepicker6'  name="start_time" required="" placeholder="Select Start date and time" value="{{$scheduledDevice->start_time}}" />
                                </div>
                                     <div class="form-group">
                                       
                                       <input type='text' class="form-control" id='datetimepicker7' placeholder="Select end date and time" value="{{$scheduledDevice->end_time}}" name="end_time" required="" />
                                       </div>
                                    <input type="submit" name="" class="btn btn-primary" style="width: 100%;" value="submit">

                                 </form>
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
        
    $("#deviceTemplates").select2({

        placeholder: "Select Device Template",
        allowClear: true,
        templateResult: function (idioma) {
            if(idioma.id>0){
                var url = "{{asset('')}}"+idioma.title;
                var $span = $("<span><img width='50' height='50' src='"+url+"'/>  "+idioma.text+" </span>");
                return $span;
            }
        },
        templateSelection: function (idioma) {
           if(idioma.id>0){
             var url = "{{asset('')}}"+idioma.title;
                var $span = $("<span>" + "<img  style='width: 37px;\n" +
                    "    height: 24px;\n" +
                    "    border-radius: 3px;' src='"+url+"'/></span>");
                return $span;
           }else{
            return "Select Device Template";
           }
        }
    });
    
</script>
<script type="text/javascript">
   $(function () {
       $('#datetimepicker6').datetimepicker({
        format: 'MM/DD/YYYY HH:mm',
        sideBySide: true,
       });
       $('#datetimepicker7').datetimepicker({
           useCurrent: false,
           format: 'MM/DD/YYYY HH:mm',
           sideBySide: true,
        });
       $("#datetimepicker6").on("dp.change", function (e) {
           $('#datetimepicker7').val('');
           $('#datetimepicker7').data("DateTimePicker").minDate(e.date);

       });
       $("#datetimepicker7").on("dp.change", function (e) {
           $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
       });
   });
   
</script>
<script>
     
   
     
  </script>
@endsection
