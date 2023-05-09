<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('description')->nullable();
            $table->text('private_price');
            $table->text('group_price');
            $table->boolean('isPublished')->default(0)->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('zoom_courses');
    }
}
