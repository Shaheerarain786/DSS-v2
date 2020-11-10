<?php


namespace App\Services;

use App\Device;
use App\DeviceGroup;
class AssignDeviceGroup
{
    public function assignDeviceGroup($request)
    {
        $deviceGroupId = $request['name'];
        $deviceGroup = DeviceGroup::with('branch.city.zone')->findOrFail($deviceGroupId);
        foreach ($request['device'] as $device)
        {
            $devices = Device::findOrFail($device);
            $devices->device_group_id = $deviceGroupId;
            $devices->zone_id   = $deviceGroup->branch->city->zone->id;
            $devices->city_id   = $deviceGroup->branch->city->id;
            $devices->branch_id = $deviceGroup->branch->id;
             
            $devices->save();

        }
    }
}
