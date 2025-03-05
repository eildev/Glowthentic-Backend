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
        Schema::create('combo_image_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('combo_id');
            $table->string('image');
            $table->foreign('combo_id')->references('id')->on('combos')->onDelete('cascade');
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_image_galleries');
    }
};
