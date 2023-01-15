<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username' , 40)->nullable();
            $table->string('mobile' , 14)->nullable();
            $table->string('cardNumber' , 16)->nullable();
            $table->string('shaba', 24)->nullable();
            $table->integer('balance')->default(0);
            $table->string('telegram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('ip')->nullable();
            $table->string('facebook')->nullable();
            $table->enum('status' , \Modules\User\Models\User::$statuses)->nullable();
            $table->foreign('image_id')->references('id')->on('media')->onDelete('set null');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
