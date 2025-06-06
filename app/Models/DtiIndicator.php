<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtiIndicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'dti_category_id',
        'type',
        'max_value',
        'description',
        'is_active'
    ];

    // Ép kiểu cho trường 'is_active'
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Mối quan hệ: Một chỉ số thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(DtiCategory::class, 'dti_category_id');
    }

    // Mối quan hệ: Một chỉ số có nhiều bản ghi dữ liệu
    public function dataEntries()
    {
        return $this->hasMany(DtiDataEntry::class);
    }
}