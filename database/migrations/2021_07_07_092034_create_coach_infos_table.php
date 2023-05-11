<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_info', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('coach_id');
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->text('about')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedIn')->nullable();
            $table->text('gmail')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('isAllowedForMakingSession')->nullable()->default(0);
            $table->string('isAllowedForPublishCourses')->nullable()->default(0);
            $table->string('isAllowedForPublishBlogs')->nullable()->default(0);

            $table->foreign('coach_id')
            ->references('id')
            ->on('coaches')
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
        Schema::dropIfExists('coach_infos');
    }
}
