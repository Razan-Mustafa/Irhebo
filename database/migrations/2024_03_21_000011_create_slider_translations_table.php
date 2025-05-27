<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slider_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slider_id')->constrained()->onDelete('cascade');
            $table->string('language', 5);
            $table->string('title');
            $table->text('description');
            $table->string('button_text')->nullable();
            $table->string('media_path')->nullable();
            $table->enum('media_type',['image','video']);
            $table->timestamps();
            $table->unique(['slider_id', 'language']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slider_translations');
    }
};
