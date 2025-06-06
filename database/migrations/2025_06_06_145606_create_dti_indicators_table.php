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
        Schema::create('dti_indicators', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên chỉ số (ví dụ: Tỷ lệ dịch vụ công trực tuyến mức 4)
            $table->string('code')->unique(); // Mã chỉ số (ví dụ: SC01)
            $table->foreignId('dti_category_id')->constrained('dti_categories')->onDelete('cascade'); // Khóa ngoại tới danh mục
            $table->enum('type', ['numeric', 'percentage', 'boolean', 'text', 'decimal']); // Kiểu dữ liệu của chỉ số
            $table->decimal('max_value', 8, 2)->nullable(); // Giá trị tối đa (ví dụ: 100 cho %)
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true); // Chỉ số có đang hoạt động không
            $table->timestamps();

            $table->unique(['name', 'dti_category_id']); // Đảm bảo tên chỉ số là duy nhất trong một danh mục
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dti_indicators');
    }
};