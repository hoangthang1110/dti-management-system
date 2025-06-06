<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtiDataEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'dti_indicator_id',
        'user_id',
        'entry_date',
        'entry_period',
        'numeric_value',
        'boolean_value',
        'text_value',
        'notes',
    ];

    // Ép kiểu cho các trường
    protected $casts = [
        'entry_date' => 'date',
        'boolean_value' => 'boolean',
        'numeric_value' => 'decimal:4', // Ép kiểu thành thập phân với 4 chữ số sau dấu phẩy
    ];

    // Mối quan hệ: Một bản ghi dữ liệu thuộc về một chỉ số
    public function indicator()
    {
        return $this->belongsTo(DtiIndicator::class, 'dti_indicator_id');
    }

    // Mối quan hệ: Một bản ghi dữ liệu được tạo bởi một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}