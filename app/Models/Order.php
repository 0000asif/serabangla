<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'product',
        'product_id',
        'transaction_id',
        'account_number',
        'subtotal',
        'delivery',
        'discount',
        'total',
        'quantity',
        'customer_id', // ← যোগ করুন
        'order_note',
        'status',
        'order_date',
        'card_number',
        'is_reddem',
        'courier_id',


        // Confirmation fields - জাস্ট এই কয়টা
        'confirmation_status',
        'confirmation_called_at',
        'confirmation_record_id',
        'confirmation_call_status',
        'confirmation_call_duration',
        'confirmation_dtmf_input',
        'confirmation_message',
        'customer_pressed_1',
        'customer_pressed_2',
        'transferred_to_agent',
        'confirmation_trunk_used',
        'confirmation_trunk_display',

        // Courier
        'courier_data',
        'courier_total_parcel',
        'courier_success_ratio',

        // Fraud
        'is_fraud_risk',


        'confirmation_recall_count',
        'confirmation_last_recall_at',
        'ip_address',
        'user_agent',
        'blocked_ip_id',
        'is_user_blocked', // ← নতুন ফিল্ড

    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Get status label in Bengali
     */
    public function getStatusLabel()
    {
        $statuses = [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_SHIPPED => 'Shipped',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }

    /**
     * Get status label in Bengali
     */
    public function getStatusLabelBn()
    {
        $statuses = [
            self::STATUS_PENDING => 'পেন্ডিং',
            self::STATUS_PROCESSING => 'প্রসেসিং',
            self::STATUS_SHIPPED => 'শিপড',
            self::STATUS_DELIVERED => 'ডেলিভারি সম্পন্ন',
            self::STATUS_COMPLETED => 'সম্পূর্ণ',
            self::STATUS_CANCELLED => 'বাতিল',
        ];

        return $statuses[$this->status] ?? 'অজানা';
    }

    /**
     * Get status badge class for Bootstrap
     */
    public function getStatusBadgeClass()
    {
        $classes = [
            self::STATUS_PENDING => 'warning',
            self::STATUS_PROCESSING => 'info',
            self::STATUS_SHIPPED => 'primary',
            self::STATUS_DELIVERED => 'success',
            self::STATUS_COMPLETED => 'success',
            self::STATUS_CANCELLED => 'danger',
        ];

        return $classes[$this->status] ?? 'secondary';
    }

    /**
     * Get status color for CSS
     */
    public function getStatusColor()
    {
        $colors = [
            self::STATUS_PENDING => '#ffc107',
            self::STATUS_PROCESSING => '#17a2b8',
            self::STATUS_SHIPPED => '#007bff',
            self::STATUS_DELIVERED => '#28a745',
            self::STATUS_COMPLETED => '#28a745',
            self::STATUS_CANCELLED => '#dc3545',
        ];

        return $colors[$this->status] ?? '#6c757d';
    }

    /**
     * Check if order is pending
     */
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if order is processing
     */
    public function isProcessing()
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    /**
     * Check if order is shipped
     */
    public function isShipped()
    {
        return $this->status === self::STATUS_SHIPPED;
    }

    /**
     * Check if order is delivered
     */
    public function isDelivered()
    {
        return $this->status === self::STATUS_DELIVERED;
    }

    /**
     * Check if order is completed
     */
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if order is cancelled
     */
    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * Get all available statuses
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_SHIPPED => 'Shipped',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    /**
     * Get all available statuses in Bengali
     */
    public static function getStatusesBn()
    {
        return [
            self::STATUS_PENDING => 'পেন্ডিং',
            self::STATUS_PROCESSING => 'প্রসেসিং',
            self::STATUS_SHIPPED => 'শিপড',
            self::STATUS_DELIVERED => 'ডেলিভারি সম্পন্ন',
            self::STATUS_COMPLETED => 'সম্পূর্ণ',
            self::STATUS_CANCELLED => 'বাতিল',
        ];
    }

    // Relationships
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    public function scopeShipped($query)
    {
        return $query->where('status', self::STATUS_SHIPPED);
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', self::STATUS_DELIVERED);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }

    // Accessor for formatted total
    public function getFormattedTotalAttribute()
    {
        return '৳ ' . number_format($this->total, 2);
    }

    // Accessor for formatted subtotal
    public function getFormattedSubtotalAttribute()
    {
        return '৳ ' . number_format($this->subtotal, 2);
    }

    // Mutator to ensure status is always lowercase
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value);
    }

    // Parse product details
    public function getProductDetails()
    {
        $product = $this->product;
        $details = [
            'name' => $product,
            'price' => $this->subtotal,
            'quantity' => $this->quantity,
            'is_pickle' => false
        ];

        if (strpos($product, 'আচার') !== false) {
            $details['is_pickle'] = true;
            preg_match('/\((\d+)\s*পিস\)/', $product, $matches);
            $details['quantity'] = $matches[1] ?? 1;
            $details['price'] = 1099;
        }

        return $details;
    }

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }


    protected $casts = [
        'is_user_blocked' => 'boolean',
    ];

    public function blockedIp()
    {
        return $this->belongsTo(BlockedIp::class, 'blocked_ip_id');
    }
}