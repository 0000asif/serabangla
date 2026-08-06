<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'product_id', 
        'product_name', 
        'price', 
        'quantity', 
        'total'
    ];

    /**
     * Get the order that owns the item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that owns the item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get formatted price with currency
     */
    public function getFormattedPriceAttribute()
    {
        return '৳ ' . number_format($this->price, 2);
    }

    /**
     * Get formatted total with currency
     */
    public function getFormattedTotalAttribute()
    {
        return '৳ ' . number_format($this->total, 2);
    }

    /**
     * Calculate total for this item (price × quantity)
     */
    public function calculateTotal()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Update total based on price and quantity
     */
    public function updateTotal()
    {
        $this->total = $this->calculateTotal();
        $this->save();
        return $this->total;
    }

    /**
     * Scope for items by order
     */
    public function scopeByOrder($query, $orderId)
    {
        return $query->where('order_id', $orderId);
    }

    /**
     * Scope for items by product
     */
    public function scopeByProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    /**
     * Boot method to automatically calculate total on save
     */
    protected static function booted()
    {
        static::saving(function ($item) {
            if (empty($item->total)) {
                $item->total = $item->price * $item->quantity;
            }
        });
    }
}
