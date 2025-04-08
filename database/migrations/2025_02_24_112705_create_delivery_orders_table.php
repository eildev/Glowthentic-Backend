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
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unsigned();
            $table->string('delivery_method');
            $table->string('courier_service')->nullable();
            $table->enum('delivery_status', ['shipping', 'processing', 'In Transit', 'delivered'])->default('shipping');
            $table->string('assign_to')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('status')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};
