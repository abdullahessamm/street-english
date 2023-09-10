<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseLevelReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_level_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('live_course_user_id');
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->float('attendance', 5, 2)->nullable();
            $table->float('lateness', 5, 2)->nullable();
            $table->float('participation')->nullable();
            $table->json('weakness_points')->nullable();
            $table->json('strength_points')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('level_id')
            ->references('id')
            ->on('zoom_course_levels')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('live_course_user_id')
            ->references('id')
            ->on('live_course_users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('instructor_id')
            ->references('id')
            ->on('coaches')
            ->onDelete('set null')
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
        Schema::dropIfExists('zoom_course_level_reports');
    }
}
