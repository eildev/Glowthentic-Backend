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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unsigned();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->unsignedBigInteger('combo_id')->nullable();
            $table->bigInteger('product_quantity');
            $table->decimal('total_price', '10', '2');
            // $table->string('weight');
            $table->float('unit_price');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->foreign('combo_id')
                ->references('id')
                ->on('combos')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->foreign('variant_id')
                ->references('id')
                ->on('variants');


            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
