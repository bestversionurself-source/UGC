<?php
declare(strict_types=1);
require dirname(__DIR__) . '/bootstrap.php';
api_guard(function (): void {
    require_csrf(); $userId = require_user(); $in = json_input(); $plan = (string)($in['plan'] ?? '');
    $plans = ['creator' => 99900, 'studio' => 449900];
    if (!isset($plans[$plan])) respond(['error' => 'Choose a valid plan.'], 422);
    $key = env_value('RAZORPAY_KEY_ID'); $secret = env_value('RAZORPAY_KEY_SECRET');
    if (!$key || !$secret || str_contains($key, 'replace')) respond(['error' => 'Payment gateway is not configured yet.'], 503);
    $payload = json_encode(['amount' => $plans[$plan], 'currency' => 'INR', 'receipt' => 'ugc_' . $userId . '_' . time(), 'notes' => ['user_id' => (string)$userId, 'plan' => $plan]]);
    $ch = curl_init('https://api.razorpay.com/v1/orders');
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $payload, CURLOPT_HTTPHEADER => ['Content-Type: application/json'], CURLOPT_USERPWD => $key . ':' . $secret, CURLOPT_TIMEOUT => 20]);
    $raw = curl_exec($ch); $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE); $error = curl_error($ch); curl_close($ch);
    if ($raw === false || $status < 200 || $status >= 300) { error_log('Razorpay order error: ' . $error . ' ' . $raw); respond(['error' => 'Could not start payment. Please try again.'], 502); }
    $order = json_decode($raw, true);
    db()->prepare('INSERT INTO payments (user_id, provider_order_id, plan, amount_paise) VALUES (?, ?, ?, ?)')->execute([$userId, $order['id'], $plan, $plans[$plan]]);
    respond(['key' => $key, 'order_id' => $order['id'], 'amount' => $plans[$plan], 'currency' => 'INR', 'name' => safe_user($userId)['name']]);
});
