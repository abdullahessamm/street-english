<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_certificates', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('public_certificate_link_id');
            $table->string('certificate_name');
            $table->string('serial');
            $table->string('certificate_type');
            $table->string('certificate_image');
            $table->string('slug');

            $table->foreign('public_certificate_link_id')
            ->references('id')
            ->on('public_certificate_links')
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
        Schema::dropIfExists('public_certificates');
    }
}
