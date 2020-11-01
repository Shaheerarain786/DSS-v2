<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceTemplateAsssets extends Model
{
    public function device_template_data_assets(){
        return $this->belongsTo(DeviceTemplateData::class,'template_data_id');
    }
}
