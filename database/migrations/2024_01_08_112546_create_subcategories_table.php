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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoryId')->unsigned();
            $table->string('subcategoryName', 100);
            $table->string('image')->nullable();
            $table->string('slug', 100);
            $table->tinyInteger('status')->default(1);

            $table->foreign('categoryId')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('subcategories');
    }
};
