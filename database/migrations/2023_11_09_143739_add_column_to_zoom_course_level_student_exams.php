<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToZoomCourseLevelStudentExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zoom_course_level_student_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_id')->after('level_id');
            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
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
        Schema::dropIfExists('zoom_course_level_student_exams');
    }
}
