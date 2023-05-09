<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('coach_id');
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('content');
            $table->string('banner')->nullable();
            $table->string('media_type');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->date('posted_at')->nullable();
            $table->string('slug');

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
        Schema::dropIfExists('coach_posts');
    }
}
