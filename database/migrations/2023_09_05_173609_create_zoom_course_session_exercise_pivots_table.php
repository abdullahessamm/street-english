<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseSessionExercisePivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_session_exercise_pivots', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('session_id');
            $table->boolean('opened')->default(true);
            $table->string('title', 50);

            $table->foreign('session_id')
            ->references('id')
            ->on('zoom_course_sessions')
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
        Schema::dropIfExists('zoom_course_session_exercise_pivots');
    }
}
