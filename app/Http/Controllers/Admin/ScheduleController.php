<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\City;
use App\Device;
use App\DeviceGroup;
use App\DeviceTemplateData;
use App\DeviceTemplates;
use App\Http\Controllers\Controller;
use App\Http\Requests\SchedulePostRequest;
use App\ScheduleTemplates;
use App\Zone;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Datatables;
class ScheduleController extends Controller
{
    public function index()
    {
        $zones = Zone::all();
        $deviceTemplateData = DeviceTemplateData::with('device_templates')->get();
        return view('admin.schedule.index',
            compact('zones','deviceTemplateData'));
    }
    public function cities($zone_id){
        $cities = City::where('zone_id', $zone_id)->get();
        return json_encode($cities);
    }
    public function branches($city_id){
        $branches = Branch::where('city_id', $city_id)->get();
        return json_encode($branches);
    }
    public function deviceGroups($branch_id){
        $deviceGroups = DeviceGroup::where('branch_id', $branch_id)->get();
        return json_encode($deviceGroups);
    }
    public function devices(Request $request){
        $orientation = $request->orientation;
        $devices = [];
        if($request->deviceGroup_id){
           $devices = Device::where(['device_group_id' => $request->deviceGroup_id, 'device_orientation'=>$orientation] )->get();
            return json_encode($devices);
        }
        if($request->branch_id){
            $devices = Device::where(['branch_id' => $request->branch_id, 'device_orientation'=>$orientation] )->get();
            return json_encode($devices);
        }
        if($request->city_id){
            $devices = Device::where(['city_id' => $request->city_id, 'device_orientation'=>$orientation] )->get();
            return json_encode($devices);
        }else{
            
             $devices = Device::where(['zone_id' => $request->zone_id, 'device_orientation'=>$orientation] )->get();
            return json_encode($devices);

        }
       
    }
    public function create(Request $request){
       // dd($request->all());
        $orientation = $request->orientation;
        $devices = [];
            
        if($request->devices){
            foreach ($request->devices as  $device) {
                $check = Schedule::where('device_id', $device)->where('start_time', '>=', $request->strart_time)->Where('end_time', '<=', $request->end_time)->first();
             
                if(!$check){
                    $d = Device::findOrFail($device);
                    Schedule::create([
                        'zone_id'   => $d->zone_id,
                        'city_id'   => $d->city_id,
                        'branch_id' => $d->branch_id,
                        'device_group_id'=> $d->device_group_id,
                        'device_id' => $device,
                        'start_time' => $request->strart_time,
                        'end_time' => $request->end_time,
                        'device_template_data_id'=> $request->deviceTemplate,
                       ]);   
                }
               
            }
           
        }else{
            if($request->deviceGroup_id){
               $devices = Device::where(['device_group_id'=> $request->deviceGroup_id, 'device_orientation' => $orientation])->get();
            }elseif($request->branch_id){
                $devices = Device::where(['branch_id'=> $request->branch_id, 'device_orientation' => $orientation])->get();
            }elseif($request->city_id){

                $devices = Device::where(['city_id'=> $request->city_id, 'device_orientation' => $orientation])->get();
            
            }else{

                $devices = Device::where(['zone_id'=> $request->zone_id, 'device_orientation' => $orientation])->get();
            
            }
            foreach ($devices as  $device) {
                $check = Schedule::where('device_id', $device->id)->where('start_time', '>=', $request->strart_time)->Where('end_time', '<=', $request->end_time)->first();
             
                if(!$check){
                    $d = Device::findOrFail($device->id);
                    Schedule::create([
                        'zone_id'   => $d->zone_id,
                        'city_id'   => $d->city_id,
                        'branch_id' => $d->branch_id,
                        'device_group_id'=> $d->device_group_id,
                        'device_id' => $device->id,
                        'start_time' => $request->strart_time,
                        'end_time' => $request->end_time,
                        'device_template_data_id'=> $request->deviceTemplate,
                       ]);   
                }
               
            }
           
        }
        return redirect('schedule')->with("success","Scheudle Created successfully");

    }
    public function view(){
        $zones = Zone::all();
        return view('admin.schedule.view', compact('zones'));
    }
    public function edit ($id){
       
       $scheduledDevice = Schedule::with('device')->findOrFail($id);
       $deviceTemplateData = DeviceTemplateData::with('device_templates')->get();
       return view('admin.schedule.edit', compact('scheduledDevice', 'deviceTemplateData'));
    }
    public function update(Request $request, $id){

             
        $scheduledDevice = Schedule::findOrFail($id);
        
        $check = Schedule::where('device_id', $scheduledDevice->device_id)->where('start_time', '>=', $request->start_time)->Where('end_time', '<=', $request->end_time)->whereNotIn('id', [$id])->first();
        
        if(!$check){
            $scheduledDevice->device_template_data_id = $request->deviceTemplate;
            $scheduledDevice->start_time = $request->start_time;
            $scheduledDevice->end_time  = $request->end_time;
            $scheduledDevice->update();
            return redirect('schedule-view')->with("success","Scheudle Updated successfully");
        }else{
            return redirect('schedule-view')->with("error","Scheudle Not Updated! Because this device has already sceduled during this time slot");
        }
        
    }
    public function scheduleDevices(Request $request){
        if($request->device_group_id){
            $sceduleDevices = Schedule::with(['zone', 'city', 'branch', 'deviceGroup', 'device', 'deviceTemplateData.device_templates'])->where('device_group_id', $request->device_group_id)->get();   
        }elseif($request->branch_id){
            $sceduleDevices = Schedule::with(['zone', 'city', 'branch', 'deviceGroup', 'device', 'deviceTemplateData.device_templates'])->where('branch_id', $request->branch_id)->get();
        }elseif($request->city_id){
            $sceduleDevices = Schedule::with(['zone', 'city', 'branch', 'deviceGroup', 'device', 'deviceTemplateData.device_templates'])->where('city_id', $request->city_id)->get();
        }elseif($request->zone_id){
            $sceduleDevices = Schedule::with(['zone', 'city', 'branch', 'deviceGroup', 'device', 'deviceTemplateData.device_templates'])->where('zone_id', $request->zone_id)->get();
        }else{
            $sceduleDevices = Schedule::with(['zone', 'city', 'branch', 'deviceGroup', 'device', 'deviceTemplateData.device_templates'])->get();   
        }
         

         return  datatables()->of($sceduleDevices)
                        ->addIndexColumn()
                        ->editColumn('city_id', function(Schedule $data){
                            return $data->city->name;
                        })
                        ->editColumn('branch_id', function(Schedule $data){
                            return $data->branch->branch_name;
                        })
                        ->editColumn('device_group_id', function(Schedule $data){
                            return $data->deviceGroup->name;
                        })
                         ->editColumn('device_id', function(Schedule $data){
                            return $data->device->device_name;
                        })
                         
                          ->addColumn('device_template', function (Schedule $data) { 
                            $imageUrl = $data->deviceTemplateData->device_templates->template_images;
                        return '<img src="'.asset( $imageUrl).'" border="0" width="40" class="img-rounded" align="center" />' ." ".$data->deviceTemplateData->ticker_text;
                            
                        })
                          ->addColumn('edit', function (Schedule $data) { 
                            $url = url('/schedule-edit/'.$data->id);
                        return '<a href="'.$url.'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
                            
                        })->rawColumns(['device_template', 'edit'])
                        ->make(true);
     }
}
