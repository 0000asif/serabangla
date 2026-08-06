<?php
// app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'order_count',
        'blocked'
    ];
    
    protected $casts = [
        'blocked' => 'boolean',
        'order_count' => 'integer'
    ];
    
    /**
     * ??? ????? ???? ??? ???? ??? ????
     */
    public static function isBlocked($phone)
    {
        return self::where('phone', $phone)
                   ->where('blocked', 1)
                   ->exists();
    }
    
    /**
     * ????? ???? ????
     */
    public static function blockUser($phone, $reason = null)
    {
        $customer = self::where('phone', $phone)->first();
        
        if ($customer) {
            $customer->blocked = 1;
            $customer->save();
            
            \Log::info('User blocked', [
                'phone' => $phone,
                'name' => $customer->name,
                'reason' => $reason
            ]);
            
            return $customer;
        }
        
        return null;
    }
    
    /**
     * ????? ?????? ????
     */
    public static function unblockUser($phone)
    {
        $customer = self::where('phone', $phone)->first();
        
        if ($customer) {
            $customer->blocked = 0;
            $customer->save();
            
            \Log::info('User unblocked', [
                'phone' => $phone,
                'name' => $customer->name
            ]);
            
            return $customer;
        }
        
        return null;
    }
}