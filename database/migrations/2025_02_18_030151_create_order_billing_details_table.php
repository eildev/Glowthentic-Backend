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
        Schema::create('order_billing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 16);
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('division');
            $table->string('post_code');
            $table->string('country');
            $table->string('order_notes')->nullable();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('order_billing_details');
    }
};
