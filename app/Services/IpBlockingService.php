<?php
// app/Services/IpBlockingService.php

namespace App\Services;

use App\Models\BlockedIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IpBlockingService
{
    public function getUserIp(Request $request)
    {
        $ip = $request->ip();

        if ($request->hasHeader('CF-Connecting-IP')) {
            $ip = $request->header('CF-Connecting-IP');
        } elseif ($request->hasHeader('X-Forwarded-For')) {
            $ip = explode(',', $request->header('X-Forwarded-For'))[0];
        } elseif ($request->hasHeader('X-Real-IP')) {
            $ip = $request->header('X-Real-IP');
        }

        return trim($ip);
    }

    /**
     * IP ব্লক করুন
     */
    public function blockIp($ip, $reason = null, $expiresInHours = null)
    {
        // IP ভ্যালিডেশন
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            Log::warning('Invalid IP address attempted to block', ['ip' => $ip]);
            throw new \Exception('Invalid IP address');
        }

        $existing = BlockedIp::where('ip_address', $ip)->first();

        if ($existing) {
            $existing->active = true;
            $existing->block_count = ($existing->block_count ?? 0) + 1;
            $existing->reason = $reason ?? $existing->reason ?? 'অননুমোদিত অ্যাক্সেস';
            $existing->blocked_by = auth()->user()->name ?? 'system';
            if ($expiresInHours) {
                $existing->expires_at = now()->addHours($expiresInHours);
            }
            $existing->save();

            Log::info('IP re-blocked', [
                'ip' => $ip,
                'block_count' => $existing->block_count,
                'reason' => $reason
            ]);

            return $existing;
        }

        $blockedIp = BlockedIp::create([
            'ip_address' => $ip,
            'reason' => $reason ?? 'অননুমোদিত অ্যাক্সেস',
            'active' => true,
            'blocked_by' => auth()->user()->name ?? 'system',
            'expires_at' => $expiresInHours ? now()->addHours($expiresInHours) : null,
            'block_count' => 1
        ]);

        Log::info('IP blocked', [
            'ip' => $ip,
            'reason' => $reason,
            'blocked_by' => auth()->user()->name ?? 'system'
        ]);

        return $blockedIp;
    }

    /**
     * IP আনব্লক করুন
     */
    public function unblockIp($ip)
    {
        $blockedIp = BlockedIp::where('ip_address', $ip)->first();

        if ($blockedIp) {
            $blockedIp->active = false;
            $blockedIp->save();

            Log::info('IP unblocked', [
                'ip' => $ip,
                'unblocked_by' => auth()->user()->name ?? 'system'
            ]);

            return true;
        }

        return false;
    }
}