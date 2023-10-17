<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseLevelExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_level_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('level_id')->unique();
            $table->unsignedBigInteger('exam_id');
            $table->timestamp('start_at');
            $table->timestamp('student_can_start_until')->nullable();
            $table->tinyInteger('duration')->unsigned();

            $table->foreign('level_id')
            ->references('id')
            ->on('zoom_course_levels')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('zoom_course_level_exams');
    }
}
