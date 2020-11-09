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

class ScheduleController extends Controller
{
    public function index()
    {
        $zones = Zone::with('branches.devices')->get();
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
            $branch = Branch::where('id',$request->branch_id )->with(['devices' => function ($query) use ($orientation) { 
                    $query->where('devices.device_orientation',  $orientation); 
                }])->first();
            return $branch->devices;
        }
        if($request->city_id){
            $city = City::where('id',$request->city_id )->with(['branches.devices' => function ($query) use ($orientation) { 
                    $query->where('devices.device_orientation',  $orientation); 
                }])->first();
             
            foreach ($city->branches as $branch) {
                foreach($branch->devices as $device){
                    array_push($devices, $device);
                }   
            }
            return json_encode($devices);
        }else{
            
            $zone = Zone::where('id',$request->zone_id )->with(['branches.devices' => function ($query) use ($orientation) { 
                    $query->where('devices.device_orientation',  $orientation); 
                }])->first();
            
            foreach ($zone->branches as $branch) {
                foreach($branch->devices as $device){
                    array_push($devices, $device);
                }   
            }
        return json_encode($devices);
        }
       
    }
    public function create(Request $request){
        //dd($request->all());
        if($request->devices){
            foreach ($request->devices as  $device) {
                $check = Schedule::where('device_id', $device)->where('start_time', '>=', $request->strart_time)->Where('end_time', '<=', $request->end_time)->first();
             
                if(!$check){
                    Schedule::create([
                        'device_id' => $device,
                        'start_time' => $request->strart_time,
                        'end_time' => $request->end_time,
                        'template_id'=> $request->deviceTemplate
                       ]);   
                }
               
            }
           
        }else{
            $orientation = $request->orientation;
            $devices = [];
            if($request->deviceGroup_id){
               $devices = Device::where(['device_group_id' => $request->deviceGroup_id, 'device_orientation'=>$orientation] )->get();
            
            }elseif($request->branch_id){
                $branch = Branch::where('id',$request->branch_id )->with(['devices' => function ($query) use ($orientation) { 
                    $query->where('devices.device_orientation',  $orientation); 
                    }])->first();
                $devices = $branch->devices;
            }elseif($request->city_id){
                $city = City::where('id',$request->city_id )->with(['branches.devices' => function ($query) use ($orientation) { 
                        $query->where('devices.device_orientation',  $orientation); 
                    }])->first();
                 
                foreach ($city->branches as $branch) {
                    foreach($branch->devices as $device){
                        array_push($devices, $device);
                    }   
                }
            
            }else{
                
                $zone = Zone::where('id',$request->zone_id )->with(['branches.devices' => function ($query) use ($orientation) { 
                        $query->where('devices.device_orientation',  $orientation); 
                    }])->first();
                
                foreach ($zone->branches as $branch) {
                    foreach($branch->devices as $device){
                        array_push($devices, $device);
                    }   
                }
            
            }
            foreach ($devices as  $device) {
                $check = Schedule::where('device_id', $device->id)->where('start_time', '>=', $request->strart_time)->Where('end_time', '<=', $request->end_time)->first();
             
                if(!$check){
                    Schedule::create([
                        'device_id' => $device->id,
                        'start_time' => $request->strart_time,
                        'end_time' => $request->end_time,
                        'template_id'=> $request->deviceTemplate
                       ]);   
                }
               
            }
           
        }
        return redirect('schedule')->with("success","Scheudle Created successfully");

    }
}
