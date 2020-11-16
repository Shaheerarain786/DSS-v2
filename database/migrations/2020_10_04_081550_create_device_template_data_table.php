<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTemplateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_template_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo');
            $table->string('ticker_text');
            $table->integer('organization_id')->nullable();
            $table->integer('template_id');
            $table->tinyInteger('is_deleted')->comment('0 = no, 1 = yes')->default(0);
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
        Schema::dropIfExists('device_template_data');
    }
}
