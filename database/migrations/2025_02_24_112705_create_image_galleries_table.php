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
        Schema::create('image_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_banner_id');
            $table->string('image', 100);
            $table->foreign('offer_banner_id')
                ->references('id')
                ->on('offer_banners')
                ->onDelete('cascade');
            $table->timestamps(0);
             $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_galleries');
    }
};
