<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/db.php';

startSecureSession();

if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: /admin/dashboard.php');
    exit;
}

$csrfToken = generateCsrfToken();
$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $submittedToken = $_POST['csrf_token'] ?? '';

    if (!verifyCsrfToken($submittedToken)) {
        $loginError = 'Security validation failed.';
    } else {
        try {
            $pdo = getDbConnection();
            $stmt = $pdo->prepare('SELECT id, name, email, password FROM admins WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password'])) {
                session_regenerate_id(true);
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = (int) $admin['id'];
                $_SESSION['admin_email'] = $admin['email'];
                $_SESSION['admin_name'] = $admin['name'];
                header('Location: /admin/dashboard.php');
                exit;
            }

            $loginError = 'Invalid email or password.';
        } catch (Throwable $e) {
            $loginError = 'Unable to verify credentials at this time.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Doric Multimedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-panel">
            <div class="login-brand">
                <img src="/images/dmpl_logo.png" alt="Doric Multimedia logo">
            </div>

            <h2>Welcome back</h2>
            <p class="login-subtitle">Sign in to access the Doric content admin dashboard.</p>

            <?php if (!empty($loginError)) : ?>
                <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <form class="login-form" method="post" action="/admin/" novalidate>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">

                <div class="field-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" placeholder="admin@doricmultimedia.com" required>
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                </div>

                <button type="submit" class="login-submit">Sign In</button>
            </form>

            <div class="login-footer">Secure admin access for Doric Multimedia.</div>
        </div>
    </div>
</body>
</html>
