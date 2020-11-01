<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\BranchDevices;
use App\Device;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::query()->with('branches')->get();

        return view('admin.devices.index', compact('devices'));
    }


    public function create()
    {
        return view('admin.devices.create');
    }

    public function store(DeviceRequest $request)
    {
        Device::query()->create($request->all());

        return redirect('devices')->with('success', 'Device registered successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $devices = Device::query()->findOrFail($id);

        return view('admin.devices.edit', compact('devices'));
    }


    public function update(Request $request, $id)
    {
        $device = Device::query()->findOrFail($id);

        $device->update($request->all());

        return redirect('devices')->with('success', 'Updated Successfully');
    }

    public function destroy($id)
    {
        $device = Device::query()->findOrFail($id)->delete();

        return redirect('devices')->with('Device Deleted Successfully');
    }
}
