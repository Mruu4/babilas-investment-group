<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technology_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technology_project_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->enum('type', ['image', 'video', 'document'])->default('image');
            $table->string('caption')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technology_media');
    }
};
