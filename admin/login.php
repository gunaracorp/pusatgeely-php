<?php
/** Admin login page */
require_once __DIR__ . '/../includes/page-shell.php';

// If already logged in, redirect
if (admin_logged_in()) {
    header('Location: /admin/index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (hash_equals(ADMIN_PASSWORD, $password)) {
        $_SESSION['admin_auth'] = true;
        session_regenerate_id(true);
        header('Location: /admin/index.php');
        exit;
    }
    $error = 'Password salah. Coba lagi.';
    // Rate limit login attempts
    rate_limit_check('admin_login_' . client_ip(), 5, 300);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login — Pusat Geely</title>
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
    <style>
        body { display:flex; align-items:center; justify-content:center; min-height:100vh; }
        .login-card { width:100%; max-width:24rem; padding:2rem; background:var(--card); border:1px solid var(--border); border-radius:var(--radius-xl); }
        .login-card h1 { font-family:var(--font-display); font-size:1.5rem; font-weight:800; text-align:center; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>🔒 Admin Panel</h1>
        <p style="text-align:center; color:var(--muted-foreground); margin-top:0.5rem; font-size:0.875rem;">Pusat Geely</p>

        <?php if ($error): ?>
        <div class="form-error" style="margin-top:1.5rem;"><?= e($error); ?></div>
        <?php endif; ?>

        <form method="POST" style="margin-top:1.5rem;">
            <input type="hidden" name="csrf" value="<?= e(csrf_token()); ?>">
            <label class="label" for="password">Password</label>
            <input type="password" class="input" name="password" id="password" required autofocus style="margin-top:0.5rem;">
            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:1.25rem;">Masuk</button>
        </form>

        <a href="/" style="display:block; text-align:center; margin-top:1.5rem; font-size:0.8125rem; color:var(--muted-foreground);">← Kembali ke website</a>
    </div>
</body>
</html>
