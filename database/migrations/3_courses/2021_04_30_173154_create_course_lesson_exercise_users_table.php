<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLessonExerciseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lesson_exercise_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_lesson_exercise_id');
            $table->boolean('isFinished')->default(0);

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('course_lesson_exercise_id')
            ->references('id')
            ->on('course_lesson_exercises')
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
        Schema::dropIfExists('course_lesson_exercise_users');
    }
}
