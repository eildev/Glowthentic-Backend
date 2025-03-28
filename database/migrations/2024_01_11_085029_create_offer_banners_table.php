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
        Schema::create('offer_banners', function (Blueprint $table) {
            $table->id();
            $table->string('head', 50);
            $table->string('title', 100);
            $table->string('short_description', 100);
            $table->string('link', 255);
            $table->string('link_button', 255);
            $table->string('image', 200);
            $table->enum('status',['cart1','cart2','cart3','cart4','cart5']);
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_banners');
    }
};
