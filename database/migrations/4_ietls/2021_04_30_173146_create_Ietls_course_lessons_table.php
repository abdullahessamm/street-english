<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIetlsCourseLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ietls_course_lessons', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('Ietls_course_content_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->nullable();            
            $table->string('slug');
            
            $table->foreign('Ietls_course_content_id')
            ->references('id')
            ->on('Ietls_course_contents')
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
        Schema::dropIfExists('Ietls_course_lessons');
    }
}
