<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agriculture_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('location');
            $table->string('agriculture_type'); // Crop Production, Livestock, Agro-processing, Agricultural Development
            $table->text('description')->nullable();
            $table->text('investment_information')->nullable();
            $table->enum('status', ['Active', 'Completed', 'Planned', 'On Hold'])->default('Active');
            $table->boolean('is_featured')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agriculture_projects');
    }
};
