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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('attachment')->nullable();
            $table->enum('source', ['website', 'mail', 'whatsapp', 'facebook', 'others', 'admin'])->default('website');
            $table->string('source_reference')->nullable();
            $table->enum('status', ['pending', 'in-progress', 'solve', 'issue', 'other'])->default('pending');
            $table->string('note')->nullable();
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
