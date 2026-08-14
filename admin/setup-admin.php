<?php
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    echo 'Forbidden.';
    exit;
}

require __DIR__ . '/includes/db.php';

try {
    $pdo = getDbConnection();

    $count = (int) $pdo->query('SELECT COUNT(*) FROM admins')->fetchColumn();

    if ($count === 0) {
        $hash = password_hash('Doric@2026!', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)');
        $stmt->execute([
            ':name' => 'Doric Admin',
            ':email' => 'admin@doricmultimedia.com',
            ':password' => $hash,
        ]);

        echo "Admin account created successfully.\n";
    } else {
        echo "Admin account already exists.\n";
    }

    $rows = $pdo->query('SELECT id, name, email FROM admins ORDER BY id ASC');
    foreach ($rows as $row) {
        echo $row['id'] . '| ' . $row['name'] . '| ' . $row['email'] . PHP_EOL;
    }
} catch (Throwable $e) {
    echo 'Admin setup failed: ' . $e->getMessage() . PHP_EOL;
    exit(1);
}
