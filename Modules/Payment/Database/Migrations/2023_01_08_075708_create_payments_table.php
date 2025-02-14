<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->morphs('paymentable');
            $table->string('amount', 10);
            $table->string('invoice_id');
            $table->string('gateWay');
            $table->enum('status', \Modules\Payment\Models\Payment::$statuses);
            $table->tinyInteger('seller_percent')->unsigned();
            $table->string('seller_share', 10);
            $table->string('site_share', 10);
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
        Schema::dropIfExists('payments');
    }
}
