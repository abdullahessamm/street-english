<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicCertificateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_certificate_links', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('certificate_username');
            $table->string('certificate_user_email');
            $table->string('certificates_link');
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
        Schema::dropIfExists('public_certificate_links');
    }
}
