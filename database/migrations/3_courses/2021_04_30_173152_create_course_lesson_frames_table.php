<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLessonFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_lesson_frames', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('course_lesson_id');
            $table->text('url');
            
            $table->foreign('course_lesson_id')
            ->references('id')
            ->on('course_lessons')
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
        Schema::dropIfExists('course_lesson_frames');
    }
}
