<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'device_name' => 'required|unique:devices',
            'device_no' => 'required',
            'device_ip' => 'required',
            'device_model' => 'required',
            'device_screen_height' => 'required',
            'device_screen_width' => 'required',
            'device_storage_memory' => 'required',
            'screen_resolution' => 'required'
        ];
    }
}
