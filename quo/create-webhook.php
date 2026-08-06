<?php
/**
 * Quo Webhook Creator
 * File: create-webhook.php
 * 
 * এই ফাইলটি Quo-তে একটি নতুন ওয়েবহুক তৈরি করবে
 */

// আপনার API Key
$apiKey = '87743dbb983c7a7bfbc6e027d6a2580ac5b8a388bc52ed6e765bcaec4091381b';

// আপনার সার্ভারের URL (যেখানে webhook-test.php ফাইল থাকবে)
// উদাহরণ: https://your-domain.com/webhook-test.php
$webhookUrl = 'https://your-domain.com/webhook-test.php'; // <<< এইটা পরিবর্তন করুন

// Quo API endpoint
$url = 'https://api.quo.com/webhooks';

// ওয়েবহুকের জন্য ডেটা
$data = [
    'url' => $webhookUrl,
    'events' => [
        'message.received',
        'call.completed', 
        'call.answered',
        'call.ringing',
        'call.voicemail.completed'
    ],
    'label' => 'My PHP Webhook Test',
    'status' => 'enabled'
];

// cURL রিকোয়েস্ট পাঠান
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: ' . $apiKey,
    'Content-Type: application/json',
    'x-quo-api-version: 2026-03-30'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// রেসপন্স দেখান
echo "HTTP Status: " . $httpCode . "\n\n";

if ($httpCode === 201 || $httpCode === 200) {
    $result = json_decode($response, true);
    echo "✅ ওয়েবহুক সফলভাবে তৈরি হয়েছে!\n\n";
    echo "Webhook ID: " . ($result['data']['id'] ?? 'N/A') . "\n";
    echo "Webhook Secret: " . ($result['data']['key'] ?? 'N/A') . "\n\n";
    echo "আপনার Webhook Secret সংরক্ষণ করুন: " . ($result['data']['key'] ?? 'N/A') . "\n";
    echo "এই Secret দিয়ে আপনি সিগনেচার ভেরিফাই করতে পারবেন।\n";
    
    // সিক্রেট কী সংরক্ষণ করুন
    if (isset($result['data']['key'])) {
        file_put_contents('webhook-secret.txt', $result['data']['key']);
        echo "\nSecret কী 'webhook-secret.txt' ফাইলে সংরক্ষণ করা হয়েছে।\n";
    }
} else {
    echo "❌ ওয়েবহুক তৈরি করতে ব্যর্থ হয়েছে!\n";
    echo "Error: " . $response . "\n";
}
?>
