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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->integer('sub_subcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->unsigned();
            $table->json('product_feature')->nullable();
            $table->string('product_name');
            $table->string('unit_id')->nullable();
            $table->string('slug', 200)->index();
            $table->bigInteger('created_by')->nullable();
            $table->string('sku');
            $table->enum('shipping_charge',['free','paid'])->default('paid');
            $table->tinyInteger('status')->default(1)->index();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
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
        Schema::dropIfExists('products');
    }
};
