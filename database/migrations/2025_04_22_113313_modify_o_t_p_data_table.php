<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('o_t_p_data', function (Blueprint $table) {
            if (!Schema::hasColumn('o_t_p_data', 'email')) {
                $table->string('email')->nullable()->index()->after('phone');
            }
            $table->timestamp('expire_at')->nullable()->change();
            $table->string('phone')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('o_t_p_data', function (Blueprint $table) {
            if (Schema::hasColumn('o_t_p_data', 'email')) {
                $table->dropColumn('email');
            }
            $table->string('expire_at')->nullable()->change();
            $table->string('phone')->nullable()->change();
        });
    }
};
