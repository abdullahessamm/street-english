<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIetlsCourseLessonExerciseAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ietls_course_lesson_exercise_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('exercise_user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->unsignedBigInteger('correct_answer_id');
            $table->string('score');

            $table->foreign('exercise_user_id')
            ->references('id')
            ->on('Ietls_course_lesson_exercise_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('question_id')
            ->references('id')
            ->on('exam_questions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('answer_id')
            ->references('id')
            ->on('exam_answers')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('correct_answer_id')
            ->references('id')
            ->on('exam_correct_answers')
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
        Schema::dropIfExists('Ietls_course_lesson_exercise_answers');
    }
}
