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
        Schema::create('billing_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->boolean('is_default');
            $table->enum('status',['saved','draft'])->nullable();
            $table->enum('active_payment_method', ['card', 'mobile_banking', 'COD']);
            $table->string('card_number')->nullable();
            $table->string('cvc_code')->nullable();
            $table->longText('card_expiry_date')->nullable();
            $table->integer('mobile_banking_id')->nullable();
            $table->boolean('verified_mobile')->nullable();
            $table->integer('verified_mobile_number')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_information');
    }
};
