<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Zone;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function index()
    {
        $zones = Zone::with('cities.branches.device_group.devices')->get();

        return view('admin.relations.index', compact('zones'));
    }
}
