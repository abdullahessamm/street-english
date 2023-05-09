<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserIetlsCourseTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_Ietls_course_tracks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('ielts_user_id');
            $table->unsignedBigInteger('Ietls_course_id');
            $table->unsignedBigInteger('Ietls_course_content_id');
            $table->unsignedBigInteger('Ietls_course_lesson_id');

            $table->foreign('ielts_user_id')
            ->references('id')
            ->on('ielts_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('Ietls_course_id')
            ->references('id')
            ->on('Ietls_courses')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('Ietls_course_content_id')
            ->references('id')
            ->on('Ietls_course_contents')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('Ietls_course_lesson_id')
            ->references('id')
            ->on('Ietls_course_lessons')
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
        Schema::dropIfExists('user_Ietls_course_tracks');
    }
}
