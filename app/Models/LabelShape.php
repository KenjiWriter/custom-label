<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LabelShape extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon_path',
        'base_price_multiplier',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'base_price_multiplier' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get predefined sizes for this shape
     */
    public function predefinedSizes(): HasMany
    {
        return $this->hasMany(PredefinedSize::class)->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Get label projects using this shape
     */
    public function labelProjects(): HasMany
    {
        return $this->hasMany(LabelProject::class);
    }

    /**
     * Scope for active shapes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}