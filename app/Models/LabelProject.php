<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LabelProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'label_shape_id',
        'label_material_id',
        'predefined_size_id',
        'laminate_option_id',
        'custom_width_mm',
        'custom_height_mm',
        'quantity',
        'artwork_file_path',
        'calculated_price',
        'status',
        'user_id',
        'session_id'
    ];

    protected $casts = [
        'calculated_price' => 'decimal:2',
        'custom_width_mm' => 'integer',
        'custom_height_mm' => 'integer',
        'quantity' => 'integer'
    ];

    // WAŻNE: UUID generation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    // Relationships
    public function labelShape()
    {
        return $this->belongsTo(LabelShape::class);
    }

    public function labelMaterial()
    {
        return $this->belongsTo(LabelMaterial::class);
    }

    public function predefinedSize()
    {
        return $this->belongsTo(PredefinedSize::class);
    }

    public function laminateOption()
    {
        return $this->belongsTo(LaminateOption::class);
    }

    public function getActualDimensions()
    {
        try {
            // Custom dimensions
            if ($this->custom_width_mm > 0 && $this->custom_height_mm > 0) {
                return [
                    'width' => (int) $this->custom_width_mm,
                    'height' => (int) $this->custom_height_mm
                ];
            }

            // Predefined size
            if ($this->predefinedSize && $this->predefinedSize->width_mm > 0 && $this->predefinedSize->height_mm > 0) {
                return [
                    'width' => (int) $this->predefinedSize->width_mm,
                    'height' => (int) $this->predefinedSize->height_mm
                ];
            }

            // Fallback based on shape
            if ($this->labelShape && $this->labelShape->slug) {
                switch ($this->labelShape->slug) {
                    case 'circle':
                        return ['width' => 50, 'height' => 50];
                    case 'square':
                        return ['width' => 50, 'height' => 50];
                    case 'rectangle':
                        return ['width' => 60, 'height' => 40];
                    case 'oval':
                        return ['width' => 60, 'height' => 40];
                    case 'star':
                        return ['width' => 50, 'height' => 50];
                    default:
                        return ['width' => 50, 'height' => 50];
                }
            }

            return ['width' => 50, 'height' => 50];

        } catch (\Exception $e) {
            \Log::error('Error in getActualDimensions', [
                'project_id' => $this->id,
                'error' => $e->getMessage()
            ]);

            return ['width' => 50, 'height' => 50];
        }
    }


    // Calculate area in cm²
    public function getAreaInCm2()
    {
        $dimensions = $this->getActualDimensions();
        return ($dimensions['width'] * $dimensions['height']) / 100;
    }

    // Check if project is valid for preview
    public function isValidForPreview()
    {
        return $this->labelShape &&
               $this->labelMaterial &&
               ($this->predefinedSize || ($this->custom_width_mm && $this->custom_height_mm)) &&
               $this->quantity > 0;
    }
}
