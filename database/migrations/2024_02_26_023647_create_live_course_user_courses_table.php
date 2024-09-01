<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveCourseUserCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_course_user_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->date('started_at');
            $table->date('delayed_at')->nullable();
            $table->date('finished_at')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('live_course_users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('course_id')
                ->references('id')
                ->on('zoom_courses')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_course_user_courses');
    }
}
