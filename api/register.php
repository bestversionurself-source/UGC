<?php
declare(strict_types=1);
require dirname(__DIR__) . '/bootstrap.php';
api_guard(function (): void {
    require_csrf(); $in = json_input();
    $name = trim((string)($in['name'] ?? '')); $email = strtolower(trim((string)($in['email'] ?? ''))); $password = (string)($in['password'] ?? '');
    if (mb_strlen($name) < 2 || mb_strlen($name) > 100) respond(['error' => 'Enter your full name.'], 422);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 190) respond(['error' => 'Enter a valid email address.'], 422);
    if (strlen($password) < 10 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) respond(['error' => 'Use at least 10 characters with a letter and number.'], 422);
    $stmt = db()->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');
    try { $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]); }
    catch (PDOException $e) { if ((int)($e->errorInfo[1] ?? 0) === 1062) respond(['error' => 'An account with this email already exists.'], 409); throw $e; }
    session_regenerate_id(true); $_SESSION['user_id'] = (int)db()->lastInsertId(); $_SESSION['csrf'] = bin2hex(random_bytes(32));
    respond(['user' => safe_user($_SESSION['user_id']), 'csrf' => csrf_token()], 201);
});
