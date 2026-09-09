<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('property_type'); // e.g. Apartment, House, Land, Commercial
            $table->string('location');
            $table->decimal('price', 15, 2)->nullable();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('bedrooms')->nullable();
            $table->unsignedSmallInteger('bathrooms')->nullable();
            $table->string('size')->nullable(); // e.g. "2,400 sqft"
            $table->json('features')->nullable(); // e.g. ["Pool","Garage","Garden"]
            $table->enum('status', ['Available', 'Sold', 'Under Development', 'Coming Soon'])
                  ->default('Available');
            $table->boolean('is_featured')->default(false);
            $table->string('video_url')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
