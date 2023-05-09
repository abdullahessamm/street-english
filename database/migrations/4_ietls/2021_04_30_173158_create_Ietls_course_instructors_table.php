<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIetlsCourseInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ietls_course_instructors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('coach_id');
            $table->unsignedBigInteger('Ietls_course_id');
            $table->boolean('suspend')->nullable()->default(0);
            $table->boolean('approved')->nullable()->default(0);
            
            $table->foreign('coach_id')
            ->references('id')
            ->on('coaches')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('Ietls_course_id')
            ->references('id')
            ->on('Ietls_courses')
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
        Schema::dropIfExists('Ietls_course_instructors');
    }
}
