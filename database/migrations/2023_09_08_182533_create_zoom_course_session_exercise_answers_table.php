<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseSessionExerciseAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_session_exercise_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('student_exercise_id');
            $table->unsignedBigInteger('exam_section_question_id');
            $table->json('student_answer');
            $table->json('instructor_correction');
            $table->tinyInteger('score');

            $table->foreign('student_exercise_id', 'student_excercise_constrain')
            ->references('id')
            ->on('zoom_course_session_student_exercises')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('exam_section_question_id', 'excercise_question_constrain')
            ->references('id')
            ->on('exam_section_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_course_session_exercise_answers');
    }
}
