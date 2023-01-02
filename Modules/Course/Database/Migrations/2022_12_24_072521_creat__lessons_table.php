<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id');
            $table->foreignId('user_id');
            $table->foreignId('season_id')->nullable();
            $table->foreignId('media_id')->nullable();
            $table->boolean('free')->default(false);
            $table->string('title');
            $table->string('number')->nullable();
            $table->string('slug');
            $table->longText('body')->nullable();
            $table->tinyInteger('time')->nullable();
            $table->enum('confirmation_status' , \Modules\Course\Models\lesson::$confirmationStatuses)
            ->default(\Modules\Course\Models\lesson::CONFIRMATION_STATUS_PENDING);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('set null');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
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
        //
    }
}
