<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LabelProject extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'session_id', 
        'label_shape_id',
        'label_material_id',
        'laminate_option_id',
        'predefined_size_id',
        'custom_width_mm',
        'custom_height_mm',
        'quantity',
        'calculated_price',
        'artwork_file_path',
        'status',
    ];

    protected $casts = [
        'calculated_price' => 'decimal:2',
    ];

    // Relations
    public function labelShape()
    {
        return $this->belongsTo(LabelShape::class);
    }

    public function labelMaterial()
    {
        return $this->belongsTo(LabelMaterial::class);
    }

    public function laminateOption()
    {
        return $this->belongsTo(LaminateOption::class);
    }

    public function predefinedSize()
    {
        return $this->belongsTo(PredefinedSize::class);
    }

    // Helper methods
    public function getActualDimensions()
    {
        if ($this->custom_width_mm && $this->custom_height_mm) {
            return [
                'width_mm' => $this->custom_width_mm,
                'height_mm' => $this->custom_height_mm,
            ];
        }

        if ($this->predefinedSize) {
            return [
                'width_mm' => $this->predefinedSize->width_mm,
                'height_mm' => $this->predefinedSize->height_mm,
            ];
        }

        return [
            'width_mm' => 100,
            'height_mm' => 60,
        ];
    }

    public function getAreaCm2()
    {
        $dimensions = $this->getActualDimensions();
        return ($dimensions['width_mm'] * $dimensions['height_mm']) / 100;
    }

    public function isReadyForPreview()
    {
        return $this->label_shape_id && 
               $this->label_material_id && 
               $this->quantity > 0;
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            if (empty($project->uuid)) {
                $project->uuid = Str::uuid();
            }
            
            // Set user_id or session_id for guest users
            if (auth()->check()) {
                $project->user_id = auth()->id();
            } else {
                $project->session_id = session()->getId();
            }
        });
    }
}