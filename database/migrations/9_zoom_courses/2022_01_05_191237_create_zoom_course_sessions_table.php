<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_sessions', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('zoom_course_level_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('exersice_id')->nullable();
            $table->string('slug');

            $table->foreign('zoom_course_level_id')
            ->references('id')
            ->on('zoom_course_levels')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('exersice_id')
            ->references('id')
            ->on('exercises')
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
        Schema::dropIfExists('zoom_course_sessions');
    }
}
