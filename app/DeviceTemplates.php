<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DeviceTemplates extends Model
{
    protected $fillable = ['id','name','images_required','videos_required','ppt_required','template_images'];

    public function device(){
        $this->belongsTo(Device::class);
    }

    public function device_template_data(){
        return $this->hasMany(DeviceTemplateData::class,'template_id');
    }
}
