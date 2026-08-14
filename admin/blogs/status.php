<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/db.php';

startSecureSession();
requireAdminAuth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/blogs/index.php');
    exit;
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    $_SESSION['flash_message'] = 'Security validation failed.';
    $_SESSION['flash_type'] = 'danger';
    header('Location: /admin/blogs/index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
$action = $_POST['action'] ?? '';

if ($id <= 0 || !in_array($action, ['publish', 'draft'], true)) {
    $_SESSION['flash_message'] = 'Invalid blog action.';
    $_SESSION['flash_type'] = 'danger';
    header('Location: /admin/blogs/index.php');
    exit;
}

$pdo = getDbConnection();
$status = $action === 'publish' ? 'published' : 'draft';
$publishedAt = $status === 'published' ? date('Y-m-d H:i:s') : null;

$stmt = $pdo->prepare('UPDATE blogs SET status = :status, published_at = :published_at, updated_at = :updated_at WHERE id = :id');
$stmt->execute([
    ':status' => $status,
    ':published_at' => $publishedAt,
    ':updated_at' => date('Y-m-d H:i:s'),
    ':id' => $id,
]);

$_SESSION['flash_message'] = $status === 'published' ? 'Blog published successfully!' : 'Blog moved to draft successfully!';
$_SESSION['flash_type'] = 'success';
header('Location: /admin/blogs/index.php');
exit;
