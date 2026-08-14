<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/blog_helpers.php';

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
if ($id <= 0) {
    $_SESSION['flash_message'] = 'Invalid blog selected.';
    $_SESSION['flash_type'] = 'danger';
    header('Location: /admin/blogs/index.php');
    exit;
}

$pdo = getDbConnection();
$stmt = $pdo->prepare('SELECT featured_image FROM blogs WHERE id = :id LIMIT 1');
$stmt->execute([':id' => $id]);
$blog = $stmt->fetch();

if ($blog && !empty($blog['featured_image'])) {
    removeFeaturedImageFile($blog['featured_image']);
}

$deleteStmt = $pdo->prepare('DELETE FROM blogs WHERE id = :id');
$deleteStmt->execute([':id' => $id]);

$_SESSION['flash_message'] = 'Blog deleted successfully!';
$_SESSION['flash_type'] = 'success';
header('Location: /admin/blogs/index.php');
exit;
