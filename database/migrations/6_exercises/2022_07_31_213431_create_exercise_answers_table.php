<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('exercise_user_id');
            $table->unsignedBigInteger('exercise_question_id');
            $table->text('my_answer')->nullable();
            $table->text('correct_answer')->nullable();
            $table->string('question_score')->nullable();
            $table->string('user_score')->nullable();
            $table->boolean('isAnswerCorrect')->nullable()->default(0);

            $table->foreign('exercise_user_id')
            ->references('id')
            ->on('exercise_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('exercise_question_id')
            ->references('id')
            ->on('exercise_questions')
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
        Schema::dropIfExists('exercise_answers');
    }
}
