<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseLevelGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_level_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zoom_course_level_id');
            $table->string('name', 80);
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->timestamps();

            $table->foreign('zoom_course_level_id')
            ->references('id')
            ->on('zoom_course_levels')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('instructor_id')
            ->references('id')
            ->on('coaches')
            ->onDelete('set null')
            ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_course_level_groups');
    }
}
