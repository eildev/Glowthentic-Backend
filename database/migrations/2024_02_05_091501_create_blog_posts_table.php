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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id');
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
            $table->string('tags')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default('0');
            $table->foreign('cat_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
