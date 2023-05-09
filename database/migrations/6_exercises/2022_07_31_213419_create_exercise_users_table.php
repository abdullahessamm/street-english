<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('live_course_user_id');
            $table->boolean('hasJoined')->default(0)->nullable();
            $table->dateTime('joined_at')->nullable();
            $table->boolean('hasFinished')->default(0)->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->text('browser')->nullable();
            $table->text('os')->nullable();
            $table->text('ip')->nullable();
            $table->boolean('isBot')->nullable();
            $table->boolean('hasCheated')->default(0)->nullable();
            $table->boolean('hasBeenCorrected')->default(0)->nullable();
            $table->string('slug');

            $table->foreign('exercise_id')
            ->references('id')
            ->on('exercises')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('live_course_user_id')
            ->references('id')
            ->on('live_course_users')
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
        Schema::dropIfExists('exercise_users');
    }
}
