<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roadmaps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('roadmappable_id');
            $table->string('roadmappable_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roadmaps');
    }};
