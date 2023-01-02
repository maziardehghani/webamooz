<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id');
            $table->foreignId('category_id')->nullable();
            $table->foreignId('banner_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->float('priority')->nullable();
            $table->string('price' , 10);
            $table->string('percent' , 5);
            $table->enum('type' , \Modules\Course\Models\courses::$types);
            $table->enum('status' , \Modules\Course\Models\courses::$statuses);
            $table->enum('confirmation_status' , \Modules\Course\Models\courses::$confirmationStatuses);
            $table->longText('description')->nullable();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('set null');
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
        Schema::dropIfExists('courses');
    }
}
