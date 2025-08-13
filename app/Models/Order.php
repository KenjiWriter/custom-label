<?php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'order_number',
        'user_id',
        'session_id',
        'customer_data',
        'subtotal',
        'tax_amount',
        'shipping_cost',
        'total_amount',
        'payment_status',
        'payment_method',
        'payment_transaction_id',
        'status',
    ];

    protected $casts = [
        'customer_data' => 'array',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->order_number)) {
                $model->order_number = 'ORD-' . date('Y') . '-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Get the user who placed this order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get order items
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Calculate totals based on items
     */
    public function calculateTotals(): void
    {
        $this->subtotal = $this->orderItems->sum('total_price');
        $this->tax_amount = $this->subtotal * 0.23; // 23% VAT for Poland
        $this->total_amount = $this->subtotal + $this->tax_amount + $this->shipping_cost;
        $this->save();
    }
}