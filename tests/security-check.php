<?php
declare(strict_types=1);
require dirname(__DIR__) . '/bootstrap.php';
$hash = password_hash('ExamplePass123', PASSWORD_DEFAULT);
assert(password_verify('ExamplePass123', $hash));
assert(!password_verify('wrong', $hash));
assert(strlen(csrf_token()) === 64);
$secret = 'test_secret'; $order = 'order_123'; $payment = 'pay_123';
$signature = hash_hmac('sha256', $order . '|' . $payment, $secret);
assert(hash_equals($signature, hash_hmac('sha256', $order . '|' . $payment, $secret)));
echo "Security primitives OK\n";
