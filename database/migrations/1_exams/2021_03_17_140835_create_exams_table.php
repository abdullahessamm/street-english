<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->string('exam_name');
            $table->boolean('take_exam_anytime')->nullable()->default(0);
            $table->time('exam_hours')->nullable();;
            $table->string('exam_timezone')->nullable();
            $table->date('exam_date')->nullable();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->string('full_mark')->nullable();
            $table->string('slug');
            $table->boolean('publish')->nullable()->default(0);
            $table->boolean('for_anyone')->default(1);
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
        Schema::dropIfExists('exams');
    }
}
