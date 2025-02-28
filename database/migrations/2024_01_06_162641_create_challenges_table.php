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
            $table->integer('status')->default(0);
            $table->integer('host_degree')->default(0);
            $table->integer('guest_degree')->default(0);
            $table->unsignedBigInteger('winner_user_id')->nullable();

            $table->timestamps();

            $table->foreign('winner_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('host_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('guest_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenges');
    }};
