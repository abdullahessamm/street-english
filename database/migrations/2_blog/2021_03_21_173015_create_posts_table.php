<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('post_category_id');
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('content');
            $table->string('banner')->nullable();
            $table->string('media_type');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->date('posted_at')->nullable();
            $table->string('slug');

            $table->foreign('post_category_id')
            ->references('id')
            ->on('post_categories')
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
        Schema::dropIfExists('posts');
    }
}
