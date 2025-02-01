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
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('banner_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->float('priority')->nullable();
            $table->string('price' , 10);
            $table->string('percent' , 5);
            $table->enum('type' , \Modules\Course\Models\courses::$types);
            $table->enum('status' , \Modules\Course\Models\courses::$statuses);
            $table->enum('confirmation_status' , \Modules\Course\Models\courses::$confirmationStatuses);
            $table->longText('description')->nullable();
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
