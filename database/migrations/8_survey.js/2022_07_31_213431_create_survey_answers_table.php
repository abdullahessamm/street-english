<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('survey_user_id');
            $table->unsignedBigInteger('survey_question_id');
            $table->text('my_answer')->nullable();
            $table->text('correct_answer')->nullable();
            $table->string('question_score')->nullable();
            $table->string('user_score')->nullable();
            $table->boolean('isAnswerCorrect')->nullable()->default(0);

            $table->foreign('survey_user_id')
            ->references('id')
            ->on('survey_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('survey_question_id')
            ->references('id')
            ->on('survey_questions')
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
        Schema::dropIfExists('survey_answers');
    }
}
