<?php
declare(strict_types=1);
require dirname(__DIR__) . '/bootstrap.php';
api_guard(function (): void {
    require_csrf(); $in = json_input();
    $email = strtolower(trim((string)($in['email'] ?? ''))); $password = (string)($in['password'] ?? '');
    $ipHash = hash('sha256', ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . env_value('APP_KEY', 'local'));
    $count = db()->prepare("SELECT COUNT(*) FROM login_attempts WHERE email = ? AND ip_hash = ? AND successful = 0 AND attempted_at > (NOW() - INTERVAL 15 MINUTE)");
    $count->execute([$email, $ipHash]); if ((int)$count->fetchColumn() >= 8) respond(['error' => 'Too many attempts. Try again in 15 minutes.'], 429);
    $stmt = db()->prepare('SELECT id, password_hash FROM users WHERE email = ?'); $stmt->execute([$email]); $user = $stmt->fetch();
    $ok = $user && password_verify($password, $user['password_hash']);
    db()->prepare('INSERT INTO login_attempts (email, ip_hash, successful) VALUES (?, ?, ?)')->execute([$email, $ipHash, $ok ? 1 : 0]);
    if (!$ok) respond(['error' => 'Email or password is incorrect.'], 401);
    if (password_needs_rehash($user['password_hash'], PASSWORD_DEFAULT)) db()->prepare('UPDATE users SET password_hash = ? WHERE id = ?')->execute([password_hash($password, PASSWORD_DEFAULT), $user['id']]);
    session_regenerate_id(true); $_SESSION['user_id'] = (int)$user['id']; $_SESSION['csrf'] = bin2hex(random_bytes(32));
    respond(['user' => safe_user($_SESSION['user_id']), 'csrf' => csrf_token()]);
});
