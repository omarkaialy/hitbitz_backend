<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('host_user_id');
            $table->unsignedBigInteger('guest_user_id')->nullable();
            $table->unsignedBigInteger('quiz_id')->nullable();
            $table->boolean('accepted')->default(false);
            // Add other fields for challenge-specific data

            $table->timestamps();

            $table->foreign('host_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('guest_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenges');
    }};
