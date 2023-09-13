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
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('description')->nullable();
            $table->float('private_price', 8, 2)->unsigned();
            $table->float('private_price_per_level', 8, 2)->unsigned()->nullable();
            $table->float('group_price', 8, 2)->unsigned();
            $table->float('group_price_per_level', 8, 2)->unsigned()->nullable();
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
