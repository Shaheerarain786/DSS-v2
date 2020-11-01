<?php

namespace App\Services;

use App\Branch;
use App\DeviceGroup;

class AssignCitiesToBranches {

    function assignCitiesToBranches($request)
    {
        $cityId = $request['city_id'];

        foreach($request['branch_id'] as $branch){

            $branch =  Branch::findOrFail($branch);
            $branch->city_id = $cityId;
            $branch->save();
        }
    }
}
