<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_section_headers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->unsignedBigInteger('exam_section_id');
            $table->string('title')->nullable();
            $table->string('type', 20);
            $table->text('paragraph')->nullable();
            $table->string('picture')->nullable();
            $table->string('audio')->nullable();
            $table->string('video')->nullable();

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
        Schema::dropIfExists('exam_section_headers');
    }
}
