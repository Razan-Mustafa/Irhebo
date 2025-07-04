<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profession_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profession_id')->constrained()->onDelete('cascade');
            $table->string('language', 5);
            $table->string('title');
            $table->timestamps();

            // Add unique index to prevent duplicate translations for same language
            $table->unique(['profession_id', 'language']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profession_translations');
    }
};
