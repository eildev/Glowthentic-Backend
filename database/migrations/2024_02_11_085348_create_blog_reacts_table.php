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
        Schema::create('blog_reacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('blog_id');
            $table->foreign('blog_id')->references('id')->on('blog_posts')->onDelete('cascade');
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->integer('love')->default(0);
            $table->integer('sad')->default(0);
            $table->integer('angry')->default(0);
            $table->integer('haha')->default(0);

            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_reacts');
    }
};
