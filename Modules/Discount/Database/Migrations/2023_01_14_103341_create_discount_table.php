<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->morphs('discountable');
            $table->string('code')->nullable();
            $table->tinyInteger('percent')->unsigned();
            $table->integer('usage_limitation')->nullable()->unsigned(); //nul means unlimited
            $table->timestamp('expire_at')->nullable();
            $table->string('link' , 300);
            $table->longText('description');
            $table->enum('type' , \Modules\Discount\Model\Discount::$types)->default(\Modules\Discount\Model\Discount::TYPE_ALL);
            $table->integer('uses')->default(0)->unsigned();
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
        Schema::dropIfExists('discount');
    }
}
