<?php

use Illuminate\Database\Seeder;

class DeviceTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ["template_1",'template_2','template_3','template_4','template_5'];
        $images_required = [0,0,0,2,2];
        $video_required = [1,2,4,1,1];
        $ppt_required = [0,0,0,0,0];
        $template_image = [
            "template_images/1.png",
            "template_images/2.png",
            "template_images/3.png",
            "template_images/4.png",
            "template_images/5.png"
        ];

        foreach ($name as $key => $n){
            $device_template = new \App\DeviceTemplates();
            $device_template->name = $n;
            $device_template->images_required = $images_required[$key];
            $device_template->videos_required = $video_required[$key];
            $device_template->ppt_required = $ppt_required[$key];
            $device_template->template_images = $template_image[$key];
            $device_template->save();
        }

    }
}
