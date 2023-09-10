<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCourseLevelGroupsUsersPivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_course_level_groups_users_pivots', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('live_course_user_id');
            $table->timestamp('joined_at');

            $table->foreign('group_id')
            ->references('id')
            ->on('zoom_course_level_groups')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('live_course_user_id', 'group_user_pivot_foreign')
            ->references('id')
            ->on('live_course_users')
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
        Schema::dropIfExists('zoom_course_level_groups_users_pivots');
    }
}
