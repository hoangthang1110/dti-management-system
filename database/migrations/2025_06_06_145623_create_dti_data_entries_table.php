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
        Schema::create('dti_data_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dti_indicator_id')->constrained('dti_indicators')->onDelete('cascade'); // Khóa ngoại tới chỉ số
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Người nhập dữ liệu
            $table->date('entry_date'); // Ngày nhập dữ liệu (ví dụ: cuối quý, cuối năm)
            $table->string('entry_period')->nullable(); // Chu kỳ nhập (ví dụ: 'Q1-2024', '2024')
            $table->decimal('numeric_value', 12, 4)->nullable(); // Giá trị số/thập phân
            $table->boolean('boolean_value')->nullable(); // Giá trị boolean (true/false)
            $table->text('text_value')->nullable(); // Giá trị văn bản
            $table->text('notes')->nullable(); // Ghi chú thêm
            $table->timestamps();

            // Đảm bảo mỗi chỉ số chỉ có một bản ghi cho một ngày/chu kỳ và người nhập cụ thể
            $table->unique(['dti_indicator_id', 'entry_date', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dti_data_entries');
    }
};