<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_correct_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');

            $table->foreign('question_id')
            ->references('id')
            ->on('exam_questions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('answer_id')
            ->references('id')
            ->on('exam_answers')
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
        Schema::dropIfExists('correct_answers');
    }
}
