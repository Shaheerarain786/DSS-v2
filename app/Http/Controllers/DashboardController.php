<?php

namespace App\Http\Controllers;

use App\Branch;
use App\City;
use App\Device;
use App\DeviceGroup;
use App\Organization;
use App\Zone;
use Illuminate\Support\Facades\Session;
use App\Schedule;
class DashboardController extends Controller
{
    public function index(){

        $branches = Branch::all()->count();
        $organizations = Organization::all()->count();
        $zones = Zone::all()->count();
        $cities = City::all()->count();
        $devices = Device::all()->count();
        $deviceGroups = DeviceGroup::all()->count();
//
//        Session::put('branches',$branches);
//        Session::put('organization',$organizations);
//        Session::put('zones',$zones);
//        Session::put('cities',$cities);
//        Session::put('devices',$devices);
//        Session::put('device_groups',$deviceGroups);
        $now =  $start_time = date('d-m-Y H:i');

        $runningSchedules = Schedule::with(['zone', 'city', 'branch', 'deviceGroup', 'device', 'deviceTemplateData.device_templates'])->where('is_deleted', 0)->where('start_time', '<=', $now )->where('end_time', '>=', $now)->get();
        return view('admin.dashboard',compact('branches','organizations','zones','cities', 'runningSchedules'));
    }
}
