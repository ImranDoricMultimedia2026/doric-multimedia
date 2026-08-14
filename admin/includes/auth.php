<?php
if (!function_exists('startSecureSession')) {
    function startSecureSession(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
            || (!empty($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);

        session_name('doric_admin_session');
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => $https,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        session_start();
    }
}

if (!function_exists('generateCsrfToken')) {
    function generateCsrfToken(): string
    {
        startSecureSession();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('verifyCsrfToken')) {
    function verifyCsrfToken(?string $token): bool
    {
        startSecureSession();

        if (!isset($_SESSION['csrf_token']) || !is_string($token)) {
            return false;
        }

        return hash_equals($_SESSION['csrf_token'], $token);
    }
}

if (!function_exists('requireAdminAuth')) {
    function requireAdminAuth(): void
    {
        startSecureSession();

        if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: /admin/');
            exit;
        }
    }
}
