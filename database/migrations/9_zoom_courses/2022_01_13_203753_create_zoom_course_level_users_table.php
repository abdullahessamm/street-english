<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseLevelUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_level_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('enrolled_for_zoom_course_id');
            $table->unsignedBigInteger('zoom_course_level_id');
            
            $table->foreign('enrolled_for_zoom_course_id')
            ->references('id')
            ->on('enrolled_students_for_zoom_courses')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('zoom_course_level_id')
            ->references('id')
            ->on('zoom_course_levels')
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
        Schema::dropIfExists('zoom_course_level_users');
    }
}
