<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseLevelStudentExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_level_student_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamp('joined_at');
            $table->timestamp('finished_at')->nullable();
            $table->tinyInteger('score')->nullable();
            $table->unsignedBigInteger('corrected_by')->nullable();
            $table->timestamp('corrected_at')->nullable();

            $table->foreign('level_id')
            ->references('id')
            ->on('zoom_course_levels')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('student_id')
            ->references('id')
            ->on('live_course_users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('corrected_by')
            ->references('id')
            ->on('coaches')
            ->onDelete('set null')
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
