<?php

namespace App\Services;

use App\Branch;
use App\City;
use App\DeviceGroup;

class AssignZoneToCities {

    function assignZoneToCities($request)
    {
        $zoneId = $request['zone_id'];

        foreach($request['city_id'] as $city){

            $branch =  City::findOrFail($city);
            $branch->zone_id = $zoneId;
            $branch->save();
        }
    }
}
