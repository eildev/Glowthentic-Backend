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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('promotion_name')->nullable();
            $table->string('cupon_code', 50)->nullable();
            $table->enum('discount_type', ['fixed', 'percentage']);
            $table->decimal('discount_value', 10, 2);
            $table->enum('type', ['coupon', 'promotion']);
            $table->enum('status', ['Active', 'Inactive', 'Expire'])->default('Active');
            $table->boolean('is_global')->default(0);
            $table->date('start_date');
            $table->date('end_date');


            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
