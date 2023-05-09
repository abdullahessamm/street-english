<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementTestUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_test_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp_number_or_phone_number')->nullable();
            $table->boolean('hasFinished')->nullable()->default(0);
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
        Schema::dropIfExists('placement_test_users');
    }
}
