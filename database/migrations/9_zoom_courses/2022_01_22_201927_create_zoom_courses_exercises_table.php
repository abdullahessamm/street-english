<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCoursesExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_courses_exercises', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('live_course_user_id');
            $table->unsignedBigInteger('zoom_course_session_id');
            $table->dateTime('joined_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            
            $table->foreign('live_course_user_id')
            ->references('id')
            ->on('live_course_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('zoom_course_session_id')
            ->references('id')
            ->on('zoom_course_sessions')
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
        Schema::dropIfExists('zoom_courses_exercises');
    }
}
