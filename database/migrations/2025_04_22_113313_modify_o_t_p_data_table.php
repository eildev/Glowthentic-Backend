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
        Schema::table('o_t_p_data', function (Blueprint $table) {
            $table->string('email')->nullable()->index()->after('phone');
            $table->timestamp('expire_at')->nullable()->change();
            $table->string('phone')->nullable()->index()->change();
        });
    }

    public function down(): void
    {
        Schema::table('o_t_p_data', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->string('expire_at')->nullable()->change();
            $table->string('phone')->change();
        });
    }
};
