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
        Schema::table('dti_categories', function (Blueprint $table) {
            // Thêm cột 'order_column' với giá trị mặc định là 0
            // Bạn có thể đặt nó sau cột 'description'
            $table->integer('order_column')->after('description')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dti_categories', function (Blueprint $table) {
            $table->dropColumn('order_column');
        });
    }
};