<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('automobile_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('automobile_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->enum('type', ['image', 'video'])->default('image');
            $table->string('caption')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('automobile_media');
    }
};
