<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseLevelPrivateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_level_private_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('private_id');
            $table->unsignedBigInteger('session_id');
            $table->timestamp('time')->nullable();
            $table->mediumInteger('duration')->unsigned()->nullable();
            $table->text('room_link')->nullable();

            $table->foreign('private_id')
            ->references('id')
            ->on('zoom_course_level_privates')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('session_id')
            ->references('id')
            ->on('zoom_course_sessions')
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
        Schema::dropIfExists('zoom_course_level_private_sessions');
    }
}
