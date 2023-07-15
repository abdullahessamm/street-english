<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSectionsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_sections_pivot', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('exam_section_id');
            $table->tinyInteger('order')->unsigned();

            $table->foreign('exam_id')
            ->references('id')
            ->on('exams')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('exam_section_id')
            ->references('id')
            ->on('exam_sections')
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
        Schema::dropIfExists('exams_sections_pivot');
    }
}
