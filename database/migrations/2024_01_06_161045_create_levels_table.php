<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roadmap_id')->constrained('roadmaps')->on('roadmaps');
            $table->string('name');
            $table->integer('order');
            $table->json('requirements');
            $table->longText('description');
            // Add other fields related to levels

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('levels');
    }
};
