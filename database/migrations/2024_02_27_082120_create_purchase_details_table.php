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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreign('company_id')->references('id')->on('company_details')->onDelete('cascade');
            $table->foreignId('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');
            $table->string('purchase_date')->nullable();
            $table->string('quantity', 10);
            $table->string('unit_price', 15);
            $table->string('total_price', 15);
            $table->string('vehicle_cost', 15)->nullable();
            $table->string('other_cost', 15)->nullable();
            $table->string('grand_total', 15)->nullable();
            $table->string('payment_method', 15)->nullable();
            $table->string('payable_amount', 15)->nullable();
            $table->string('due', 15)->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
