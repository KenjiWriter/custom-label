<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaminateOption extends Model
{
    protected $fillable = [
        'name',
        'slug', 
        'description',
        'finish_type',
        'price_multiplier',
        'texture_image_path',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'price_multiplier' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get label projects using this laminate option
     */
    public function labelProjects()
    {
        return $this->hasMany(LabelProject::class);
    }

    /**
     * Scope for active laminate options
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
