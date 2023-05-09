<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('bundle_id');
            $table->unsignedBigInteger('course_id');
            
            $table->foreign('bundle_id')
            ->references('id')
            ->on('bundles')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('course_id')
            ->references('id')
            ->on('courses')
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
        Schema::dropIfExists('bundle_courses');
    }
}
