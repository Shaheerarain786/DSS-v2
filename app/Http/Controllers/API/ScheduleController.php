<?php

namespace App\Http\Controllers\API;
use App\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function getSingleSchedule(Request $request){
        $validator = Validator::make($request->all(),[
           'start_time' => 'required',
           'device_id' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'data' => null,
                'message' => $validator->messages(),
                'status' => false
            ]);
        }
        else
        {
            $start_time = date('d-m-Y H:i' , strtotime($request->start_time));
            $schedule = Schedule::where(['device_id'=>$request->device_id, 'start_time'=>$start_time])->with('deviceTemplateData.template_assets')->first();

            return response()->json([
               'status' => true,
               'message' => 'Scedule Found',
               'data' => $schedule
            ]);
        }
    }
    public function getAllSchedules(Request $request){
        
            $schedules = Schedule::with('deviceTemplateData.template_assets')->get();
            return response()->json([
               'status' => true,
               'message' => 'Scedules Found',
               'data' => $schedules
            ]);
        
    }
}
