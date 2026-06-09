<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

     protected $fillable = [
        'order_id', 'customer_name', 'customer_phone', 'customer_email',
        'customer_address', 'payment_method', 'transaction_id', 'account_number',
        'subtotal', 'delivery', 'status', 'discount', 'total', 'order_note'
    ];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
