<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseSessionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_session_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('zoom_course_level_user_id');
            $table->unsignedBigInteger('zoom_course_session_id');
            
            $table->foreign('zoom_course_level_user_id')
            ->references('id')
            ->on('zoom_course_level_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('zoom_course_session_id')
            ->references('id')
            ->on('zoom_course_sessions')
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
        Schema::dropIfExists('zoom_course_session_users');
    }
}
