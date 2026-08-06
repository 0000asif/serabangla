<?php
// app/Models/BlockedIp.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BlockedIp extends Model
{
    use HasFactory;

    protected $table = 'blocked_ips';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'ip_address',
        'reason',
        'active',
        'blocked_by',
        'expires_at',
        'block_count',
        'notes' // ← নতুন যোগ করুন
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'active' => 'boolean',
        'expires_at' => 'datetime',
        'block_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * ডিফল্ট অ্যাট্রিবিউট ভ্যালু
     */
    protected $attributes = [
        'active' => true,
        'block_count' => 1,
    ];

    /**
     * ============================================
     * Relationships
     * ============================================
     */

    /**
     * এই IP দ্বারা করা অর্ডারসমূহ
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'blocked_ip_id');
    }

    public function ordersByIp()
    {
        return $this->hasMany(Order::class, 'ip_address', 'ip_address');
    }

    /**
     * ============================================
     * Scopes (Query Filters)
     * ============================================
     */

    /**
     * শুধুমাত্র অ্যাকটিভ (ব্লক) IP গুলো
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * শুধুমাত্র নিষ্ক্রিয় (আনব্লক) IP গুলো
     */
    public function scopeInactive($query)
    {
        return $query->where('active', 0);
    }

    /**
     * মেয়াদোত্তীর্ণ IP গুলো
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now())
            ->where('active', 1);
    }

    /**
     * মেয়াদোত্তীর্ণ হয়নি এমন IP গুলো
     */
    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
                ->orWhere('expires_at', '>', now());
        });
    }

    /**
     * IP ঠিকানা দিয়ে অনুসন্ধান
     */
    public function scopeSearch($query, $ip)
    {
        return $query->where('ip_address', 'LIKE', "%{$ip}%");
    }

    /**
     * ============================================
     * Helper Methods
     * ============================================
     */

    /**
     * IP ব্লক করা হয়েছে কিনা চেক করুন (স্ট্যাটিক মেথড)
     */
    public static function isBlocked($ip)
    {
        if (empty($ip)) {
            return false;
        }

        return self::where('ip_address', $ip)
            ->where('active', 1)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->exists();
    }

    /**
     * IP ব্লক আছে কিনা চেক করুন (ইনস্ট্যান্স মেথড)
     */
    public function isActive()
    {
        if (!$this->active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at <= now()) {
            return false;
        }

        return true;
    }

    /**
     * IP ব্লক মেয়াদ শেষ হয়েছে কিনা
     */
    public function isExpired()
    {
        if (is_null($this->expires_at)) {
            return false;
        }

        return $this->expires_at <= now();
    }

    /**
     * মেয়াদ শেষ হয়ে গেছে এমন ব্লক IP গুলো নিষ্ক্রিয় করুন
     */
    public static function expireOldBlocks()
    {
        $expired = self::where('expires_at', '<', now())
            ->where('active', 1)
            ->get();

        $count = 0;
        foreach ($expired as $block) {
            $block->active = false;
            $block->save();
            $count++;

            Log::info('IP block expired automatically', [
                'ip' => $block->ip_address,
                'expired_at' => $block->expires_at
            ]);
        }

        return $count;
    }

    /**
     * মেয়াদ বাড়ান
     */
    public function extendExpiry($hours)
    {
        if ($this->expires_at) {
            $this->expires_at = $this->expires_at->addHours($hours);
        } else {
            $this->expires_at = now()->addHours($hours);
        }

        $this->save();

        Log::info('IP block extended', [
            'ip' => $this->ip_address,
            'new_expiry' => $this->expires_at
        ]);

        return $this;
    }

    /**
     * ব্লক কাউন্ট বাড়ান
     */
    public function incrementBlockCount()
    {
        $this->block_count = ($this->block_count ?? 0) + 1;
        $this->save();

        return $this;
    }

    /**
     * সম্পূর্ণ IP ডিটেইলস পেতে
     */
    public function getDetails()
    {
        return [
            'id' => $this->id,
            'ip' => $this->ip_address,
            'reason' => $this->reason,
            'status' => $this->isActive() ? 'Blocked' : 'Unblocked',
            'blocked_by' => $this->blocked_by,
            'block_count' => $this->block_count,
            'expires_at' => $this->expires_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'is_expired' => $this->isExpired(),
            'total_orders' => $this->orders()->count(),
        ];
    }

    /**
     * ============================================
     * Accessors & Mutators
     * ============================================
     */

    /**
     * IP ঠিকানা ফরম্যাট করে দেখান
     */
    public function getFormattedIpAttribute()
    {
        $ip = $this->ip_address;

        // IPv6 সংক্ষেপ
        if (strpos($ip, ':') !== false && strlen($ip) > 15) {
            return substr($ip, 0, 15) . '...';
        }

        return $ip;
    }

    /**
     * স্ট্যাটাস টেক্সট
     */
    public function getStatusTextAttribute()
    {
        if (!$this->active) {
            return 'Unblocked';
        }

        if ($this->isExpired()) {
            return 'Expired';
        }

        return 'Blocked';
    }

    /**
     * স্ট্যাটাস ব্যাজ ক্লাস
     */
    public function getStatusBadgeClassAttribute()
    {
        if (!$this->active || $this->isExpired()) {
            return 'badge-success';
        }

        return 'badge-danger';
    }

    /**
     * ব্লক সময় কতক্ষণ হয়েছে
     */
    public function getBlockedDurationAttribute()
    {
        if (!$this->created_at) {
            return 'N/A';
        }

        return $this->created_at->diffForHumans();
    }

    /**
     * ============================================
     * Static Helper Methods
     * ============================================
     */

    /**
     * IP ব্লক বা আনব্লক টগল করুন
     */
    public static function toggleBlock($ip)
    {
        $block = self::where('ip_address', $ip)->first();

        if ($block) {
            $block->active = !$block->active;
            $block->save();

            Log::info('IP toggled', [
                'ip' => $ip,
                'new_status' => $block->active ? 'blocked' : 'unblocked'
            ]);

            return $block;
        }

        return null;
    }

    /**
     * সব অ্যাকটিভ ব্লক IP এর তালিকা
     */
    public static function getActiveBlocks()
    {
        return self::active()
            ->notExpired()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * IP ব্লক স্ট্যাটাস চেক (ক্যাশ সহ)
     */
    public static function checkWithCache($ip)
    {
        // ক্যাশ ব্যবহার করতে চাইলে
        return self::isBlocked($ip);
    }

    /**
     * ডুপ্লিকেট IP চেক
     */
    public static function findDuplicate($ip)
    {
        return self::where('ip_address', $ip)->first();
    }

    /**
     * সব ব্লক IP এর সংখ্যা
     */
    public static function countActive()
    {
        return self::active()->notExpired()->count();
    }

    /**
     * ============================================
     * Event Listeners (Optional)
     * ============================================
     */

    protected static function booted()
    {
        // তৈরি হওয়ার সময়
        static::created(function ($blockedIp) {
            Log::info('New IP blocked', [
                'ip' => $blockedIp->ip_address,
                'reason' => $blockedIp->reason,
                'blocked_by' => $blockedIp->blocked_by
            ]);
        });

        // আপডেট হওয়ার সময়
        static::updated(function ($blockedIp) {
            Log::info('IP block updated', [
                'ip' => $blockedIp->ip_address,
                'changes' => $blockedIp->getChanges()
            ]);
        });

        // ডিলিট হওয়ার সময়
        static::deleted(function ($blockedIp) {
            Log::info('IP block deleted', [
                'ip' => $blockedIp->ip_address,
                'deleted_at' => now()
            ]);
        });
    }
}