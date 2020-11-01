<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTemplateAsssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_template_asssets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_data_id')->nullable();
            $table->string('asset_url')->nullable();
            $table->string('asset_type')->nullable();
            $table->string('asset_box_number')->nullable();
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
        Schema::dropIfExists('device_template_asssets');
    }
}
