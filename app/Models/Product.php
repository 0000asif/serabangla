<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'category',
        'badge',
        'status',
        'rating',
        'images'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function orders()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
