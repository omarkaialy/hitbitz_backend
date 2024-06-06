<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_roadmap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('roadmap_id');
            $table->integer('current_level')->default(1);
            $table->integer('current_step')->default(1);
            $table->integer('completed')->default(0);
            $table->integer('rate')->default(0);
            $table->integer('progress')->default(0);
            $table->timestamps();
            $table->boolean('favored')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('roadmap_id')->references('id')->on('roadmaps')->onDelete('cascade');

            // Add any additional columns if needed
        });
        DB::statement("ALTER TABLE user_roadmap ADD CONSTRAINT rate_check CHECK (rate >= 0 AND rate <= 5)");

    }

    public function down()
    {
        Schema::dropIfExists('user_roadmap');
    }};
