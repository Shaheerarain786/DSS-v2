<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'template_id',
        'device_id',
        
    ];

    
}
