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
            $table->string('head', 50)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('short_description', 100)->nullable();
            $table->string('link', 255)->nullable();
            $table->string('link_button', 255)->nullable();
            $table->string('image', 200)->nullable();
            $table->enum('cart_status',['Active','Inactive'])->default('Active');
            $table->enum('status', ['cart1', 'cart2', 'cart3', 'cart4', 'cart5']);
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
