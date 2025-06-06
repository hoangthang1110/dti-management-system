<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtiCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description']; // Các trường có thể gán hàng loạt

    // Mối quan hệ: Một danh mục có nhiều chỉ số
    public function indicators()
    {
        return $this->hasMany(DtiIndicator::class);
    }
}