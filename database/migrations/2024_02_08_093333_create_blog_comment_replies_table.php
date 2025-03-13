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
        Schema::create('blog_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->integer('subscriber_id')->nullable();
            $table->foreignId('comment_id');
            $table->foreign('comment_id')->references('id')->on('blog_comments')->onDelete('cascade');
            $table->string('reply')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comment_replies');
    }
};
