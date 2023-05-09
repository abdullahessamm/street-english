<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIetlsCoursePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ietls_course_payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('ielts_user_id');
            $table->unsignedBigInteger('Ietls_course_id');
            $table->string('username');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->boolean('payment_status')->nullable()->default(1);

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
        Schema::dropIfExists('Ietls_course_payments');
    }
}
