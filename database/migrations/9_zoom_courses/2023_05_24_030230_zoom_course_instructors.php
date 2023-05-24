<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ZoomCourseInstructors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_instructors', function (Blueprint $table) {
            $table->unsignedBigInteger('coach_id');
            $table->unsignedBigInteger('zoom_course_id');
            $table->boolean('suspend')->nullable()->default(0);
            $table->boolean('approved')->nullable()->default(0);

            $table->foreign('coach_id')
            ->references('id')
            ->on('coaches')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

            $table->foreign('zoom_course_id')
            ->references('id')
            ->on('zoom_courses')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_course_instructors');
    }
}
