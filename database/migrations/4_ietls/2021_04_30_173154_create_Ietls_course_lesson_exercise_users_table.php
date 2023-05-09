<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIetlsCourseLessonExerciseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ietls_course_lesson_exercise_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('ielts_user_id');
            $table->unsignedBigInteger('lesson_exercise_id');
            $table->boolean('isFinished')->default(0);

            $table->foreign('ielts_user_id')
            ->references('id')
            ->on('ielts_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('lesson_exercise_id')
            ->references('id')
            ->on('Ietls_course_lesson_exercises')
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
        Schema::dropIfExists('Ietls_course_lesson_exercise_users');
    }
}
