<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('images_required')->nullable();
            $table->integer('videos_required')->nullable();
            $table->integer('ppt_required')->nullable();
            $table->string('template_images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_templates');
    }
}
