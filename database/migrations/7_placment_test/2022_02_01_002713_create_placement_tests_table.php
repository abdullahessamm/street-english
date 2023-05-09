<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_tests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('placement_test_user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            $table->unsignedBigInteger('correct_answer_id');
            $table->string('score');

            $table->foreign('placement_test_user_id')
            ->references('id')
            ->on('placement_test_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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

            $table->foreign('correct_answer_id')
            ->references('id')
            ->on('exam_correct_answers')
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
        Schema::dropIfExists('placement_tests');
    }
}
