<?php
declare(strict_types=1);
require dirname(__DIR__) . '/bootstrap.php';
api_guard(function (): void {
    require_csrf(); $userId = require_user(); $in = json_input();
    $orderId = (string)($in['razorpay_order_id'] ?? ''); $paymentId = (string)($in['razorpay_payment_id'] ?? ''); $signature = (string)($in['razorpay_signature'] ?? '');
    if (!$orderId || !$paymentId || !$signature) respond(['error' => 'Incomplete payment response.'], 422);
    $stmt = db()->prepare("SELECT id, plan, status FROM payments WHERE provider_order_id = ? AND user_id = ?"); $stmt->execute([$orderId, $userId]); $payment = $stmt->fetch();
    if (!$payment) respond(['error' => 'Payment order not found.'], 404);
    if ($payment['status'] === 'paid') respond(['ok' => true, 'user' => safe_user($userId)]);
    $expected = hash_hmac('sha256', $orderId . '|' . $paymentId, (string)env_value('RAZORPAY_KEY_SECRET', ''));
    if (!hash_equals($expected, $signature)) { db()->prepare("UPDATE payments SET status = 'failed' WHERE id = ?")->execute([$payment['id']]); respond(['error' => 'Payment verification failed.'], 400); }
    db()->beginTransaction();
    db()->prepare("UPDATE payments SET status = 'paid', provider_payment_id = ?, paid_at = NOW() WHERE id = ?")->execute([$paymentId, $payment['id']]);
    db()->prepare('UPDATE users SET plan = ? WHERE id = ?')->execute([$payment['plan'], $userId]); db()->commit();
    respond(['ok' => true, 'user' => safe_user($userId)]);
});
