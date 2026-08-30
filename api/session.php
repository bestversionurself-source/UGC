<?php
declare(strict_types=1);
require dirname(__DIR__) . '/bootstrap.php';
api_guard(function (): void {
    $user = current_user_id() ? safe_user(current_user_id()) : null;
    if (!$user && current_user_id()) unset($_SESSION['user_id']);
    respond(['user' => $user, 'csrf' => csrf_token()]);
});
