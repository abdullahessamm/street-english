<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_memberships', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('linkedIn');
            $table->string('facebook')->nullable();
            $table->string('company')->nullable();
            $table->text('topic');
            $table->string('cv');
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
        Schema::dropIfExists('instructor_memberships');
    }
}
