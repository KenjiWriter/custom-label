<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class LabelProject extends Model
{
    use HasFactory;

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
        'artwork_file_name',
        'artwork_file_size',
        'status',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'calculated_price' => 'decimal:2',
        'custom_width_mm' => 'integer',
        'custom_height_mm' => 'integer',
        'artwork_file_size' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the user who owns this project
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the label shape
     */
    public function labelShape(): BelongsTo
    {
        return $this->belongsTo(LabelShape::class);
    }

    /**
     * Get the label material
     */
    public function labelMaterial(): BelongsTo
    {
        return $this->belongsTo(LabelMaterial::class);
    }

    /**
     * Get the laminate option
     */
    public function laminateOption(): BelongsTo
    {
        return $this->belongsTo(LaminateOption::class);
    }

    /**
     * Get the predefined size
     */
    public function predefinedSize(): BelongsTo
    {
        return $this->belongsTo(PredefinedSize::class);
    }

    /**
     * Get order items for this project
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get actual dimensions (predefined or custom)
     */
    public function getActualDimensions(): array
    {
        if ($this->predefinedSize) {
            return [
                'width_mm' => $this->predefinedSize->width_mm,
                'height_mm' => $this->predefinedSize->height_mm,
            ];
        }

        return [
            'width_mm' => $this->custom_width_mm,
            'height_mm' => $this->custom_height_mm,
        ];
    }

    /**
     * Calculate area in square centimeters
     */
    public function getAreaCm2(): float
    {
        $dimensions = $this->getActualDimensions();
        return ($dimensions['width_mm'] / 10) * ($dimensions['height_mm'] / 10);
    }

    /**
     * Calculate total price
     */
    public function calculateTotalPrice(): float
    {
        $area = $this->getAreaCm2();
        $materialPrice = $this->labelMaterial->calculatePrice($area);
        
        // Apply shape multiplier
        $price = $materialPrice * $this->labelShape->base_price_multiplier;
        
        // Apply laminate multiplier if selected
        if ($this->laminateOption) {
            $price *= $this->laminateOption->price_multiplier;
        }
        
        // Multiply by quantity
        $price *= $this->quantity;
        
        return round($price, 2);
    }

    /**
     * Check if project is ready for 3D preview
     */
    public function isReadyForPreview(): bool
    {
        return $this->label_shape_id && 
               $this->label_material_id && 
               ($this->predefined_size_id || ($this->custom_width_mm && $this->custom_height_mm));
    }
}