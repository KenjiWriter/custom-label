<?php

namespace App\Services;

use App\Models\LabelProject;
use App\Models\LabelShape;
use App\Models\LabelMaterial;
use App\Models\LaminateOption;

class PriceCalculationService
{
    /**
     * Calculate price for label configuration
     */
    public function calculatePrice(array $config): float
    {
        if (!$this->isValidConfig($config)) {
            return 0.0;
        }

        $material = LabelMaterial::find($config['material_id']);
        $shape = LabelShape::find($config['shape_id']);
        $laminate = isset($config['laminate_id']) ? LaminateOption::find($config['laminate_id']) : null;

        if (!$material || !$shape) {
            return 0.0;
        }

        // Calculate area in cm²
        $area = $this->calculateArea($config);
        
        // Base material price
        $basePrice = $material->calculatePrice($area);
        
        // Apply shape multiplier
        $price = $basePrice * $shape->base_price_multiplier;
        
        // Apply laminate multiplier
        if ($laminate) {
            $price *= $laminate->price_multiplier;
        }
        
        // Apply quantity
        $quantity = $config['quantity'] ?? 1;
        $totalPrice = $price * $quantity;
        
        // Apply volume discounts
        $totalPrice = $this->applyVolumeDiscount($totalPrice, $quantity);
        
        return round($totalPrice, 2);
    }

    /**
     * Calculate area based on dimensions
     */
    private function calculateArea(array $config): float
    {
        if (isset($config['predefined_size_id'])) {
            $predefinedSize = \App\Models\PredefinedSize::find($config['predefined_size_id']);
            if ($predefinedSize) {
                return $predefinedSize->getAreaCm2();
            }
        }

        $width = $config['custom_width'] ?? 0;
        $height = $config['custom_height'] ?? 0;
        
        return ($width / 10) * ($height / 10); // Convert mm to cm
    }

    /**
     * Apply volume discounts
     */
    private function applyVolumeDiscount(float $price, int $quantity): float
    {
        if ($quantity >= 1000) {
            return $price * 0.85; // 15% discount
        } elseif ($quantity >= 500) {
            return $price * 0.90; // 10% discount
        } elseif ($quantity >= 100) {
            return $price * 0.95; // 5% discount
        }
        
        return $price;
    }

    /**
     * Validate configuration
     */
    private function isValidConfig(array $config): bool
    {
        return isset($config['shape_id']) && 
               isset($config['material_id']) && 
               (isset($config['predefined_size_id']) || 
                (isset($config['custom_width']) && isset($config['custom_height'])));
    }
}