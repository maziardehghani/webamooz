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
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->boolean('free')->default(false);
            $table->string('title');
            $table->string('number')->nullable();
            $table->string('slug');
            $table->longText('body')->nullable();
            $table->tinyInteger('time')->nullable();
            $table->enum('confirmation_status' , \Modules\Course\Models\Lesson::$confirmationStatuses)
            ->default(\Modules\Course\Models\lesson::CONFIRMATION_STATUS_PENDING);
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
