<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('automobiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('brand');
            $table->string('model');
            $table->unsignedSmallInteger('year')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->unsignedInteger('mileage')->nullable();
            $table->string('condition_status')->nullable(); // New, Used, Certified Pre-owned
            $table->json('specifications')->nullable();
            $table->enum('availability', ['Available', 'Sold', 'Reserved', 'Coming Soon'])->default('Available');
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('automobiles');
    }
};
