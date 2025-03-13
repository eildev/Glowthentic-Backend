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
        Schema::create('global_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code');
            $table->string('discount');
            $table->string('startDate');
            $table->string('expiration');
            $table->tinyInteger('status')->default(1);
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_coupons');
    }
};
