<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYallaNzakerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yalla_nzaker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->string("title");
            $table->text("link");
            $table->timestamps();

            $table->foreign('session_id')
            ->references('id')
            ->on('zoom_course_sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yalla_nzakers');
    }
}
