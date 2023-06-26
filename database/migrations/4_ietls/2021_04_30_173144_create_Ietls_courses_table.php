<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIetlsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ietls_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('Ietls_course_category_id')->nullable();
            $table->string('name');
            $table->string('duration');
            $table->string('level');
            $table->string('language');
            $table->string('price');
            $table->string('discount')->nullable();
            $table->string('thumbnail');
            $table->string('media_intro')->nullable();
            $table->string('video_url')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->text('description');
            $table->boolean('isPublished')->default(0);
            $table->string('slug');
            
            $table->foreign('Ietls_course_category_id')
            ->references('id')
            ->on('Ietls_course_categories')
            ->onUpdate('cascade')
            ->onDelete('set null');

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
        Schema::dropIfExists('courses');
    }
}
