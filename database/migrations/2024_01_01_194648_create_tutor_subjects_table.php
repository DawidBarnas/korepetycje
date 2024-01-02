<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('tutor_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutor_id');
            $table->unsignedBigInteger('subject_id');
            $table->timestamps();

            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tutor_subjects');
    }
}
