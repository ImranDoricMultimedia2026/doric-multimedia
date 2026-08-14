<?php
require __DIR__ . '/admin/includes/db.php';

$pdo = getDbConnection();
$uploadDir = __DIR__ . '/uploads/blogs';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$source = __DIR__ . '/images/no-image2.png';
$adminId = (int) $pdo->query('SELECT id FROM admins ORDER BY id ASC LIMIT 1')->fetchColumn();
$categoryId = (int) $pdo->query('SELECT id FROM categories ORDER BY id ASC LIMIT 1')->fetchColumn();
if ($adminId <= 0 || $categoryId <= 0) {
    echo "SETUP_ERROR\n";
    exit(1);
}

$createName = 'verify-image-create-' . uniqid() . '.png';
copy($source, $uploadDir . '/' . $createName);
$slug = 'verify-blog-' . uniqid();
$now = date('Y-m-d H:i:s');

$pdo->prepare('INSERT INTO blogs (title, slug, excerpt, content, featured_image, category_id, author_id, status, created_at, updated_at, published_at) VALUES (:title, :slug, :excerpt, :content, :featured_image, :category_id, :author_id, :status, :created_at, :updated_at, :published_at)')->execute([
    ':title' => 'Verification Blog Image',
    ':slug' => $slug,
    ':excerpt' => 'Verification excerpt',
    ':content' => '<p>Verification content.</p>',
    ':featured_image' => $createName,
    ':category_id' => $categoryId,
    ':author_id' => $adminId,
    ':status' => 'published',
    ':created_at' => $now,
    ':updated_at' => $now,
    ':published_at' => $now,
]);

$htmlCreate = @file_get_contents('http://127.0.0.1:8000/blog.php?slug=' . rawurlencode($slug));
$createCheck = ($htmlCreate !== false && strpos((string) $htmlCreate, '/uploads/blogs/' . rawurlencode($createName)) !== false) ? 'YES' : 'NO';
echo "CREATE_IMAGE_PRESENT={$createCheck}\n";

$editName = 'verify-image-edit-' . uniqid() . '.png';
copy($source, $uploadDir . '/' . $editName);
$pdo->prepare('UPDATE blogs SET featured_image = :featured_image, updated_at = :updated_at WHERE slug = :slug')->execute([
    ':featured_image' => $editName,
    ':updated_at' => $now,
    ':slug' => $slug,
]);

$htmlEdit = @file_get_contents('http://127.0.0.1:8000/blog.php?slug=' . rawurlencode($slug));
$editCheck = ($htmlEdit !== false && strpos((string) $htmlEdit, '/uploads/blogs/' . rawurlencode($editName)) !== false) ? 'YES' : 'NO';
echo "EDIT_IMAGE_PRESENT={$editCheck}\n";

$pdo->prepare('DELETE FROM blogs WHERE slug = :slug')->execute([':slug' => $slug]);
@unlink($uploadDir . '/' . $createName);
@unlink($uploadDir . '/' . $editName);
