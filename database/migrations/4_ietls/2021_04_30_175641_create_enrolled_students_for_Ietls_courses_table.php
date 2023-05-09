<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolledStudentsForIetlsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_students_for_Ietls_courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('ielts_user_id');
            $table->unsignedBigInteger('Ietls_course_id');
            $table->boolean('suspend')->nullable()->default(0);
            $table->timestamps();
            
            $table->foreign('ielts_user_id')
            ->references('id')
            ->on('ielts_users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('Ietls_course_id')
            ->references('id')
            ->on('Ietls_courses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolled_students_for_courses');
    }
}
