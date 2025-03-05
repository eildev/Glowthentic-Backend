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
        Schema::create('sub_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subcategoryId')->unsigned();
            $table->string('subSubcategoryName');
            $table->string('slug');
            $table->tinyInteger('status')->default(1);
            $table->timestamps(0);
            $table->softDeletes();

            $table->foreign('subcategoryId')
                ->references('id')
                ->on('subcategories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_subcategories');
    }
};
