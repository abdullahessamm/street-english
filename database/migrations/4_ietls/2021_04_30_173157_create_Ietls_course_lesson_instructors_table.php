<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIetlsCourseLessonInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ietls_course_lesson_instructors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('Ietls_course_lesson_id');
            $table->unsignedBigInteger('coach_id');
            
            $table->foreign('Ietls_course_lesson_id')
            ->references('id')
            ->on('Ietls_course_lessons')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('coach_id')
            ->references('id')
            ->on('coaches')
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
        Schema::dropIfExists('Ietls_course_lesson_instructors');
    }
}
