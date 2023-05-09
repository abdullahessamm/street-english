<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->string('username');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
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

            $table->foreign('survey_id')
            ->references('id')
            ->on('survey_js')
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
        Schema::dropIfExists('survey_users');
    }
}
