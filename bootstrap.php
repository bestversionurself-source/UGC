<?php
declare(strict_types=1);

function load_env(string $path): array {
    if (!is_file($path)) return [];
    $values = [];
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) continue;
        [$key, $value] = array_map('trim', explode('=', $line, 2));
        $values[$key] = trim($value, "\"'");
    }
    return $values;
}

$ENV = array_merge(load_env(__DIR__ . '/.env'), $_ENV);
function env_value(string $key, ?string $default = null): ?string {
    global $ENV;
    return $ENV[$key] ?? getenv($key) ?: $default;
}

$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https';
session_name('ugc_session');
session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => $https, 'httponly' => true, 'samesite' => 'Lax']);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

function db(): PDO {
    static $pdo;
    if ($pdo instanceof PDO) return $pdo;
    $host = env_value('DB_HOST'); $name = env_value('DB_NAME'); $user = env_value('DB_USER');
    if (!$host || !$name || !$user) throw new RuntimeException('Database is not configured.');
    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, env_value('DB_PORT', '3306'), $name);
    $pdo = new PDO($dsn, $user, env_value('DB_PASS', ''), [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false]);
    return $pdo;
}

function json_input(): array { $data = json_decode(file_get_contents('php://input') ?: '{}', true); return is_array($data) ? $data : []; }
function respond(array $data, int $status = 200): never {
    http_response_code($status); header('Content-Type: application/json; charset=utf-8'); header('Cache-Control: no-store');
    echo json_encode($data, JSON_UNESCAPED_SLASHES); exit;
}
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function require_csrf(): void { $sent = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ''; if ($sent === '' || !hash_equals(csrf_token(), $sent)) respond(['error' => 'Invalid security token. Refresh and try again.'], 419); }
function current_user_id(): ?int { return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null; }
function require_user(): int { $id = current_user_id(); if (!$id) respond(['error' => 'Please sign in first.'], 401); return $id; }
function safe_user(int $id): ?array { $stmt = db()->prepare('SELECT id, name, email, plan, created_at FROM users WHERE id = ?'); $stmt->execute([$id]); return $stmt->fetch() ?: null; }
function api_guard(callable $action): void {
    try { $action(); }
    catch (RuntimeException $e) { respond(['error' => $e->getMessage()], 503); }
    catch (Throwable $e) { error_log($e->getMessage()); respond(['error' => 'Something went wrong. Please try again.'], 500); }
}
