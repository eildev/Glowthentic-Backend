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
        Schema::create('user_trackers', function (Blueprint $table) {
            $table->id();
            $table->string('country', 20);
            $table->string('user_ip', 50);
            $table->text('url');
            $table->string('browser_name', 20);
            $table->string('system_user_name', 50)->nullable();
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_trackers');
    }
};
