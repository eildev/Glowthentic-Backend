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
        Schema::create('wish_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('product_id')->unsigned();
<<<<<<< HEAD
            $table->unsignedBigInteger('variant_id')->unsigned();
=======
>>>>>>> e78c430a4bdf7664f72f49fa548e4ee83aad0a20
            $table->tinyInteger('loved')->default(1);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

<<<<<<< HEAD
                $table->foreign('variant_id')
                ->references('id')
                ->on('variants')
                ->onDelete('cascade');

=======
>>>>>>> e78c430a4bdf7664f72f49fa548e4ee83aad0a20
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wish_lists');
    }
};
