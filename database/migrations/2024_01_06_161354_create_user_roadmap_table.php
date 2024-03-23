<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_roadmap', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('roadmap_id');
            $table->integer('current_level')->default(1);
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->boolean('favored')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('roadmap_id')->references('id')->on('roadmaps')->onDelete('cascade');

            // Add any additional columns if needed
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_roadmap');
    }};
