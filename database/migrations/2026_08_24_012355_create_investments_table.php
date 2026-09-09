<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // Real Estate, Agriculture, Technology, Automobiles, Stocks
            $table->text('description')->nullable();
            $table->decimal('investment_value', 15, 2)->nullable();
            $table->decimal('current_value', 15, 2)->nullable();
            $table->decimal('performance_percent', 8, 2)->nullable(); // e.g. +12.50
            $table->text('return_information')->nullable();
            $table->boolean('publicly_visible')->default(true); // admin controls what's public
            $table->enum('status', ['Active', 'Closed', 'Matured', 'Planned'])->default('Active');
            $table->date('investment_date')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
