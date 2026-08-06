<?php
/**
 * Quo Webhook Receiver with Full Features
 * File: webhook-test.php
 */

// ============================================
// ১. কনফিগারেশন
// ============================================

// API Key (যা আপনি দিয়েছেন)
define('API_KEY', '87743dbb983c7a7bfbc6e027d6a2580ac5b8a388bc52ed6e765bcaec4091381b');

// Webhook Secret (ওয়েবহুক তৈরি করার পর এটা আপডেট করুন)
// webhook-secret.txt ফাইল থেকে পড়ুন
$secretFile = __DIR__ . '/webhook-secret.txt';
if (file_exists($secretFile)) {
    define('WEBHOOK_SECRET', trim(file_get_contents($secretFile)));
} else {
    define('WEBHOOK_SECRET', null);
}

// লগ ফাইল
define('LOG_FILE', __DIR__ . '/webhook-logs.json');

// ============================================
// ২. রিকোয়েস্ট প্রসেসিং
// ============================================

// শুধু POST অনুমোদিত
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// রিকোয়েস্ট ডেটা পড়ুন
$rawInput = file_get_contents('php://input');
$headers = getallheaders();
$payload = json_decode($rawInput, true);

if ($payload === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

// ============================================
// ৩. সিক্রেট ভেরিফিকেশন (যদি থাকে)
// ============================================

if (defined('WEBHOOK_SECRET') && WEBHOOK_SECRET) {
    $signature = $headers['X-Quo-Signature'] ?? '';
    $expected = hash_hmac('sha256', $rawInput, WEBHOOK_SECRET);
    
    if (!hash_equals($expected, $signature)) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid signature']);
        
        // ফেইলড অ্যাটেম্পট লগ করুন
        logData([
            'type' => 'signature_verification_failed',
            'expected' => $expected,
            'received' => $signature
        ]);
        exit;
    }
}

// ============================================
// ৪. ইভেন্ট প্রসেসিং
// ============================================

$eventType = $payload['type'] ?? 'unknown';
$eventId = $payload['id'] ?? 'unknown';
$data = $payload['data'] ?? [];
$resource = $data['resource'] ?? [];
$context = $data['context'] ?? [];

// লগে সংরক্ষণ করুন
$logEntry = [
    'timestamp' => date('Y-m-d H:i:s'),
    'event_id' => $eventId,
    'event_type' => $eventType,
    'headers' => $headers,
    'payload' => $payload,
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];
logData($logEntry);

// ইভেন্ট অনুযায়ী অ্যাকশন
$actionResult = processEvent($payload);

// ============================================
// ৫. রেসপন্স রিটার্ন
// ============================================

http_response_code(200);
header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'message' => 'Webhook processed',
    'event_type' => $eventType,
    'action' => $actionResult
]);

// ============================================
// ৬. হেল্পার ফাংশন
// ============================================

function logData($data) {
    $logFile = LOG_FILE;
    $existing = [];
    
    if (file_exists($logFile)) {
        $content = file_get_contents($logFile);
        if (!empty($content)) {
            $existing = json_decode($content, true) ?? [];
        }
    }
    
    $existing[] = $data;
    
    // শেষ ২০০টি লগ রাখুন
    if (count($existing) > 200) {
        $existing = array_slice($existing, -200);
    }
    
    file_put_contents($logFile, json_encode($existing, JSON_PRETTY_PRINT));
}

function processEvent($payload) {
    $type = $payload['type'] ?? 'unknown';
    $data = $payload['data'] ?? [];
    $resource = $data['resource'] ?? [];
    $context = $data['context'] ?? [];
    
    $result = ['action' => 'none', 'message' => 'No action taken'];
    
    switch ($type) {
        case 'message.received':
            // কেউ এসএমএস পাঠিয়েছে
            $text = $resource['text'] ?? 'No text';
            $sender = $context['senderIdentifier'] ?? 'Unknown';
            $phoneNumber = $context['phoneNumberId'] ?? 'Unknown';
            
            // ডেটাবেসে সেভ করার মতো কাজ করুন
            $result = [
                'action' => 'sms_received',
                'message' => "📨 SMS from: $sender | Text: $text",
                'details' => [
                    'sender' => $sender,
                    'text' => $text,
                    'phone_number' => $phoneNumber,
                    'conversation_id' => $context['conversationId'] ?? null
                ]
            ];
            
            // আপনি চাইলে এখানে অটো-রিপ্লাই পাঠাতে পারেন
            // sendAutoReply($context['conversationId'], 'ধন্যবাদ! আপনার মেসেজ পেয়েছি।');
            break;
            
        case 'call.ringing':
            // কল বাজছে
            $direction = $resource['direction'] ?? 'unknown';
            $from = $context['callerIdentifier'] ?? 'Unknown';
            
            $result = [
                'action' => 'call_ringing',
                'message' => "📞 Call ringing: $from ($direction)",
                'details' => [
                    'caller' => $from,
                    'direction' => $direction,
                    'call_id' => $resource['id'] ?? null
                ]
            ];
            break;
            
        case 'call.answered':
            // কল রিসিভ হয়েছে
            $answeredBy = $context['answeredByUserId'] ?? 'Unknown user';
            $duration = $resource['duration'] ?? 0;
            
            $result = [
                'action' => 'call_answered',
                'message' => "✅ Call answered by: $answeredBy",
                'details' => [
                    'answered_by' => $answeredBy,
                    'duration' => $duration,
                    'call_id' => $resource['id'] ?? null
                ]
            ];
            break;
            
        case 'call.completed':
            // কল শেষ হয়েছে
            $direction = $resource['direction'] ?? 'unknown';
            $duration = $resource['duration'] ?? 0;
            $status = $resource['status'] ?? 'unknown';
            $from = $context['callerIdentifier'] ?? 'Unknown';
            $to = $context['recipientIdentifiers'][0] ?? 'Unknown';
            
            $result = [
                'action' => 'call_completed',
                'message' => "📞 Call ended: $direction call from $from to $to",
                'details' => [
                    'caller' => $from,
                    'recipient' => $to,
                    'duration' => $duration,
                    'status' => $status,
                    'call_id' => $resource['id'] ?? null
                ]
            ];
            
            // দীর্ঘ কল হলে নোটিফিকেশন পাঠান
            if ($duration > 60) {
                // sendNotification("Long call: {$duration}s from {$from}");
            }
            break;
            
        case 'call.voicemail.completed':
            // ভয়েসমেইল পেয়েছেন
            $url = $resource['url'] ?? 'No URL';
            $duration = $resource['duration'] ?? 0;
            $from = $context['callerIdentifier'] ?? 'Unknown';
            
            $result = [
                'action' => 'voicemail_received',
                'message' => "🎙️ Voicemail from: $from (Duration: {$duration}s)",
                'details' => [
                    'caller' => $from,
                    'duration' => $duration,
                    'audio_url' => $url,
                    'call_id' => $resource['id'] ?? null
                ]
            ];
            
            // ভয়েসমেইল ইমেইলে পাঠান
            // sendEmail('your@email.com', 'New Voicemail', "Voicemail from: $from");
            break;
            
        case 'call.recording.completed':
            // কল রেকর্ডিং পাওয়া গেছে
            $url = $resource['url'] ?? 'No URL';
            $duration = $resource['duration'] ?? 0;
            
            $result = [
                'action' => 'recording_completed',
                'message' => "🎥 Recording completed",
                'details' => [
                    'duration' => $duration,
                    'audio_url' => $url
                ]
            ];
            break;
            
        case 'contact.updated':
            // কন্টাক্ট আপডেট হয়েছে
            $contactId = $resource['id'] ?? 'Unknown';
            
            $result = [
                'action' => 'contact_updated',
                'message' => "👤 Contact updated: $contactId",
                'details' => [
                    'contact_id' => $contactId,
                    'fields' => $resource['fields'] ?? []
                ]
            ];
            break;
            
        default:
            $result = [
                'action' => 'unknown_event',
                'message' => "Event type: $type",
                'details' => ['event_type' => $type]
            ];
    }
    
    return $result;
}

// ============================================
// ৭. অতিরিক্ত ফাংশন (ঐচ্ছিক)
// ============================================

function sendAutoReply($conversationId, $message) {
    // Quo API ব্যবহার করে অটো-রিপ্লাই পাঠান
    $ch = curl_init('https://api.quo.com/messages');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'conversationId' => $conversationId,
        'text' => $message
    ]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: ' . API_KEY,
        'Content-Type: application/json',
        'x-quo-api-version: 2026-03-30'
    ]);
    curl_exec($ch);
    curl_close($ch);
}

function sendEmail($to, $subject, $body) {
    // আপনার ইমেইল ফাংশন
    // mail($to, $subject, $body);
}
?>
