<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('submitter_name')->nullable();
            $table->string('submitter_email')->nullable();
            $table->json('data');
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('forms');
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_submission');
    }
}
