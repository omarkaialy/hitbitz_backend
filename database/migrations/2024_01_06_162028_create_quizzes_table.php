<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_detail_id');
            $table->foreign('level_detail_id')->references('id')->on('level_details')->onDelete('cascade');
            $table->string('name');
            $table->integer('order');
            $table->text('description');
            $table->integer('required_degree')->default(60);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
