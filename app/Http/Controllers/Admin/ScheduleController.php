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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        $zones = Zone::all();
        $cities = City::all();
        $branches = Branch::all();
        $deviceGroups = DeviceGroup::all();
        $devices = Device::all();
        $deviceTemplateData = DeviceTemplateData::all();

        return view('admin.schedule.index',
            compact('zones','cities','branches','deviceGroups','devices','deviceTemplateData'));
    }
}
