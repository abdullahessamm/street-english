<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkWithUsFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_with_us_form', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('whatsapp_number');
            $table->date('dob');
            $table->text('address');
            $table->string('matrial_status');
            $table->string('military_status');
            $table->string('personal_id_number');
            $table->string('are_you_a');
            $table->string('graduation_year');
            $table->text('educational_background');
            $table->text('why_are_you_applying');
            $table->string('how_long_have_you_been_working');
            $table->text('name_3_places');
            $table->text('extra_qualifications');
            $table->string('salaray');
            $table->string('work_date_availability');
            $table->string('answer_the_following_3_Questions');
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
        Schema::dropIfExists('work_with_us_forms');
    }
}
