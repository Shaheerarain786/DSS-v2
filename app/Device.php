<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected  $fillable = [
        'device_name',
        'device_no',
        'device_ip',
        'device_model',
        'device_screen_height',
        'device_screen_width',
        'device_storage_memory',
        'screen_resolution',
        'device_orientation'
    ];

    public function branches(){
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function device_templates(){
        return $this->hasMany(DeviceTemplates::class);
    }

    public function device_group()
    {
        return $this->belongsTo(DeviceGroup::class,'device_group_id');
    }
}
