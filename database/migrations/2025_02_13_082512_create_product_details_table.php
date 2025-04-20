<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->longText('ingredients')->nullable();
            $table->longText('usage_instruction')->nullable();
            $table->enum('gender', ['male', 'female', 'unisex'])->default('unisex');
            $table->bigInteger('created_by');
            $table->string('short_description')->nullable();
            $table->string('product_policy')->nullable();
            $table->bigInteger('approved_by')->nullable();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
