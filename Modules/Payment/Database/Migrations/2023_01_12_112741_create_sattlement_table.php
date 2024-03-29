<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSattlementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sattlement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('transaction_id' , 30)->nullable();
            $table->json('from')->nullable();
            $table->json('to')->nullable();
            $table->timestamp('sattlement_at');
            $table->enum('status' ,
            \Modules\Payment\Models\Sattlement::$statuses)
                ->default(\Modules\Payment\Models\Sattlement::STATUS_PENDING);
            $table->float('amount')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('sattlement');
    }
}
