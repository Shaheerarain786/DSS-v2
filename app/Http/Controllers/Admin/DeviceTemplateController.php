<?php

namespace App\Http\Controllers\Admin;

use App\Device;
use App\DeviceTemplateAsssets;
use App\DeviceTemplateData;
use App\DeviceTemplates;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceTemplateRequest;
use App\ScheduleTemplates;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;

class DeviceTemplateController extends Controller
{
    public function index()
    {
        $templates = DeviceTemplateData::with(['device_templates', 'template_assets'])->get();

        foreach ($templates as $template) {
            $template->images = DeviceTemplateAsssets::query()
                ->where('template_data_id', $template->id)->where('asset_type', 'image')->get();

            $template->videos = DeviceTemplateAsssets::query()
                ->where('template_data_id', $template->id)->where('asset_type', 'video')->get();
        }

        return view('admin.device_templates.index', compact('templates'));
    }

    public function create()
    {
        $devices = Device::all();

        return view('admin.device_templates.set_teamplate', compact('devices'));
    }

    public function show()
    {
        $deviceTemplates = DeviceTemplates::all();

        return view('admin.device_templates.new-index', compact('deviceTemplates'));
    }

    public function store_template(Request $request, DeviceTemplateRequest $deviceTemplateRequest)
    {
        $storeTemplateData = new DeviceTemplateData();
        $storeTemplateData->ticker_text = $request->ticker_text;
        $storeTemplateData->template_id = $request->template_id;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $destinationPathLogo = public_path() . '/uploads/photos';
            $file->move($destinationPathLogo, $fileName);
        }
        $storeTemplateData->logo = '/uploads/photos/' . $fileName;
        $storeTemplateData->save();

        $templateId = $request->template_id;

        $template = DeviceTemplates::query()->find($templateId);

        $requiredImages = $template->images_required;
        $requiredVideos = $template->videos_required;
        $requiredPPT = $template->ppt_required;

        for ($i = 1; $i <= $requiredVideos; $i++) { // requiredVideos = template required videos from database

            if ($request->hasFile('video_' . $i)) {

                foreach ($request->file('video_' . $i) as $key => $videos) {
                    $destinationPath = public_path() . '/uploads/videos';
                    $fileName = $videos->getClientOriginalName();
                    $videos->move($destinationPath, $fileName);

                    $this->save_template_assets('video', $i, $fileName, 'videos', $storeTemplateData->id);
                }
            }
        }

        for ($i = 1; $i <= $requiredImages; $i++) { // requiredVideos = template required videos from database

            if ($request->hasFile('image_' . $i)) {

                foreach ($request->file('image_' . $i) as $key => $images) {
                    $destinationPath = public_path() . '/uploads/images';
                    $fileName = $images->getClientOriginalName();
                    $images->move($destinationPath, $fileName);

                    $this->save_template_assets('image', $i, $fileName, 'photos', $storeTemplateData->id);
                }
            }
        }
        for ($i = 1; $i <= $requiredPPT; $i++) { // requiredVideos = template required videos from database

            if ($request->hasFile('ppt_' . $i)) {

                foreach ($request->file('ppt_' . $i) as $key => $ppt) {
                    $destinationPath = public_path() . '/uploads/ppt';
                    $fileName = $ppt->getClientOriginalName();
                    $ppt->move($destinationPath, $fileName);

                    $this->save_template_assets('ppt', $i, $fileName, 'ppt', $storeTemplateData->id);
                }
            }
        }

        return redirect('device-templates')->with('success', 'template set successfullly');
    }

    public function update($id, Request $request)
    {

    }

    public function delete_template($id)
    {
        $template_data = DeviceTemplateData::query()->findOrFail($id);

        $template_data->template_assets()->delete();

        $template_data->delete();

        return redirect('device-templates')->with('success','Template and Template Data deleted successfully');
    }

    public function validateFields($startDate, $endDate, $deviceId)
    {
        $validation = ScheduleTemplates::query()
            ->whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])->count();

        if ($validation > 1) {
            return false;
        } else {
            return true;
        }
    }

    public function format_date($date)
    {
        $date_fromat = Carbon::createFromFormat('m/d/Y h:i A', $date);

        $date_fromat = Carbon::parse($date_fromat)->format('Y-m-d H:i:s');

        return $date_fromat;
    }

    public function next_step(Request $request)
    {
        $ppt_count = $request->ppt_count;
        $video_count = $request->video_count;
        $images_count = $request->images_count;
        $template_id = $request->template_id;

        $view = view('admin.device_templates.next', compact('ppt_count', 'video_count', 'images_count', 'template_id'))->render();

        return response()->json(array('success' => true, 'html' => $view));
    }

    public function save_template_assets($type, $box_no, $fileName, $folderName, $template_id)
    {
        $template_asset_data = new DeviceTemplateAsssets();

        $template_asset_data->template_data_id = $template_id;
        $template_asset_data->asset_url = 'uploads/' . $folderName . '/' . $fileName;
        $template_asset_data->asset_type = $type;
        $template_asset_data->asset_box_number = $box_no;
        $template_asset_data->save();
    }
}
