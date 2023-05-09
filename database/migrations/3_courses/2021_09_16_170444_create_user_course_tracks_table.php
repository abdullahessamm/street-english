<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCourseTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course_track', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('course_content_id');
            $table->unsignedBigInteger('course_lesson_id');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('course_id')
            ->references('id')
            ->on('courses')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('course_content_id')
            ->references('id')
            ->on('course_contents')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('user_course_tracks');
    }
}
