<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseLevelExamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_level_exam_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('zoom_course_level_student_exam_id');
            $table->unsignedBigInteger('exam_section_question_id');
            $table->json('student_answer');
            $table->json('instructor_correction');
            $table->tinyInteger('score');

            $table->foreign('zoom_course_level_student_exam_id', 'zoom_course_level_student_exam_constraint')
            ->references('id')
            ->on('zoom_course_level_student_exams')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('exam_section_question_id', 'level_student_exam_section_question_constraint')
            ->references('id')
            ->on('exam_section_questions')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_course_level_exam_answers');
    }
}
