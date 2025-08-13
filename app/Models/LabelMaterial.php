<?php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LabelMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_per_cm2',
        'texture_image_path',
        'properties',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price_per_cm2' => 'decimal:4',
        'properties' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get label projects using this material
     */
    public function labelProjects(): HasMany
    {
        return $this->hasMany(LabelProject::class);
    }

    /**
     * Calculate price for given area in square centimeters
     */
    public function calculatePrice(float $areaCm2): float
    {
        return round($this->price_per_cm2 * $areaCm2, 2);
    }

    /**
     * Scope for active materials
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}