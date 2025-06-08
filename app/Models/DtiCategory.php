<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo
use Illuminate\Database\Eloquent\Relations\HasMany;   // Import HasMany

class DtiCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'parent_id', // Thêm parent_id vào fillable
        'order_column', // Thêm order_column vào fillable
    ];

    /**
     * Get the parent category that owns the DtiCategory.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(DtiCategory::class, 'parent_id');
    }

    /**
     * Get the child categories for the DtiCategory.
     */
    public function children(): HasMany
    {
        return $this->hasMany(DtiCategory::class, 'parent_id')->orderBy('order_column'); // Sắp xếp con theo order_column
    }

    /**
     * Check if the current category is a descendant of a given category ID.
     *
     * @param int $categoryId
     * @return bool
     */
    public function isDescendantOf(int $categoryId): bool
    {
        $parent = $this->parent;
        while ($parent) {
            if ($parent->id === $categoryId) {
                return true;
            }
            $parent = $parent->parent;
        }
        return false;
    }
}