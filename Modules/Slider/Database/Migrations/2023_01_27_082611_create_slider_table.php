<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_id')->nullable();
            $table->string('title')->nullable();
            $table->float('priority');
            $table->string('link')->nullable();
            $table->boolean('status')->default(0);
            $table->enum('type' , \Modules\Slider\Models\Slider::$types)
                ->default(\Modules\Slider\Models\Slider::DYNAMIC_BANNER);
            $table->foreign('banner_id')->references('id')->on('media')->onDelete('set null');
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
        Schema::dropIfExists('slider');
    }
}
