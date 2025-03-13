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
        Schema::create('popup_messages', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('description');
            $table->string('link');
            $table->string('image');
            $table->tinyInteger('status')->default(1);
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popup_messages');
    }
};
