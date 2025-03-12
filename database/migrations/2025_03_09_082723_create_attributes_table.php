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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->enum('data_type', [
                'int', 'tinyint', 'smallint', 'bigint',
                'decimal', 'float', 'double',
                'char', 'varchar', 'text', 'longtext',
                'date', 'datetime', 'timestamp', 'time','json',
                'boolean', 'bit', 'blob', 'binary', 'varbinary'
            ]);
            $table->json('options')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
