<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PredefinedSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'width_mm',
        'height_mm',
        'label_shape_id',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'width_mm' => 'integer',
        'height_mm' => 'integer',
        'label_shape_id' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the shape this size belongs to
     */
    public function labelShape(): BelongsTo
    {
        return $this->belongsTo(LabelShape::class);
    }

    /**
     * Get label projects using this size
     */
    public function labelProjects(): HasMany
    {
        return $this->hasMany(LabelProject::class);
    }

    /**
     * Calculate area in square centimeters
     */
    public function getAreaCm2(): float
    {
        return ($this->width_mm / 10) * ($this->height_mm / 10);
    }

    /**
     * Get formatted dimensions
     */
    public function getFormattedDimensions(): string
    {
        return "{$this->width_mm}mm × {$this->height_mm}mm";
    }

    /**
     * Scope for active sizes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}