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
            // Thêm cột parent_id, cho phép NULL
            $table->unsignedBigInteger('parent_id')->nullable()->after('description');

            // Định nghĩa khóa ngoại trỏ đến chính bảng dti_categories
            $table->foreign('parent_id')->references('id')->on('dti_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dti_categories', function (Blueprint $table) {
            // Xóa khóa ngoại trước khi xóa cột
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};