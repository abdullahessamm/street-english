<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolledStudentsForZoomCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_students_for_zoom_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('live_course_user_id');
            $table->unsignedBigInteger('zoom_course_id');
            
            $table->foreign('live_course_user_id')
            ->references('id')
            ->on('live_course_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('zoom_course_id')
            ->references('id')
            ->on('zoom_courses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('enrolled_students_for_courses');
    }
}
