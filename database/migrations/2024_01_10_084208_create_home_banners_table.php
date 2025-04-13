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
        Schema::create('home_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('short_description', 100)->nullable();
            $table->string('long_description', 200)->nullable();
            $table->string('link', 255)->nullable();
            $table->string('small_image', 200);
            $table->string('medium_image', 200);
            $table->string('large_image', 200);
            $table->string('extra_large_image', 200);
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
        Schema::dropIfExists('home_banners');
    }
};
