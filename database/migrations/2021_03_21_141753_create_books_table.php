<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->string('book_name');
            $table->string('page_number')->nullable();
            $table->text('short_description');
            $table->text('summary');
            $table->string('book_cover');
            $table->string('book_background');
            $table->string('book');
            $table->boolean('download_avaliable');
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
        Schema::dropIfExists('books');
    }
}
