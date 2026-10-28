<?php
/** Admin reviews — list pending, approve/reject */
require_once __DIR__ . '/../includes/page-shell.php';
admin_require_login();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check($_POST['csrf'] ?? null)) {
    $id = $_POST['id'] ?? '';
    $action = $_POST['action'] ?? '';
    if ($id) {
        if ($action === 'approve') {
            $pdo->prepare("UPDATE reviews SET published = 1 WHERE id = ?")->execute([$id]);
        } elseif ($action === 'unpublish') {
            $pdo->prepare("UPDATE reviews SET published = 0 WHERE id = ?")->execute([$id]);
        } elseif ($action === 'delete') {
            $pdo->prepare("DELETE FROM reviews WHERE id = ?")->execute([$id]);
        }
    }
    header('Location: /admin/reviews.php');
    exit;
}

$tab = $_GET['tab'] ?? 'pending';
$published = $tab === 'approved' ? 1 : 0;
$reviews = $pdo->prepare("SELECT * FROM reviews WHERE published = ? ORDER BY created_at DESC LIMIT 100");
$reviews->execute([$published]);
$reviews = $reviews->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Reviews — Admin Pusat Geely</title>
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
    <style>
        .admin-layout { display:grid; grid-template-columns:240px 1fr; min-height:100vh; }
        .admin-sidebar { background:var(--card); border-right:1px solid var(--border); padding:1.5rem 1rem; }
        .admin-sidebar a { display:block; padding:0.625rem 0.875rem; border-radius:var(--radius-md); font-size:0.875rem; color:var(--muted-foreground); margin-bottom:0.25rem; text-decoration:none; }
        .admin-sidebar a:hover, .admin-sidebar a.active { background:var(--muted); color:var(--foreground); }
        .admin-main { padding:2rem; }
        .review-card { background:var(--card); border:1px solid var(--border); border-radius:var(--radius-md); padding:1rem; margin-bottom:0.75rem; }
        @media (max-width: 767px) { .admin-layout { grid-template-columns:1fr; } .admin-sidebar { display:none; } }
    </style>
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar">
        <a href="/admin/index.php">📊 Dashboard</a>
        <a href="/admin/leads.php">📝 Leads</a>
        <a href="/admin/reviews.php" class="active">⭐ Reviews</a>
        <a href="/admin/export.php">📥 Export CSV</a>
        <a href="/" target="_blank">🌐 Lihat Website</a>
        <a href="/admin/logout.php">🚪 Logout</a>
    </aside>
    <main class="admin-main">
        <h1 class="font-display" style="font-size:1.875rem; font-weight:800;">Reviews</h1>

        <div style="margin-top:1rem; display:flex; gap:0.25rem;">
            <a href="?tab=pending" class="btn btn-sm <?= $tab === 'pending' ? 'btn-primary' : 'btn-outline'; ?>">Pending</a>
            <a href="?tab=approved" class="btn btn-sm <?= $tab === 'approved' ? 'btn-primary' : 'btn-outline'; ?>">Approved</a>
        </div>

        <div style="margin-top:1.5rem;">
        <?php if (empty($reviews)): ?>
            <div class="card" style="text-align:center; color:var(--muted-foreground);">Tidak ada review.</div>
        <?php else: foreach ($reviews as $r): ?>
            <div class="review-card">
                <div style="display:flex; justify-content:space-between; gap:1rem; align-items:baseline;">
                    <div>
                        <strong><?= e($r['name']); ?></strong>
                        <?php if ($r['city']): ?><span style="color:var(--muted-foreground);"> · <?= e($r['city']); ?></span><?php endif; ?>
                        <span style="margin-left:0.5rem; color:var(--primary);"><?= str_repeat('★', $r['rating']); ?></span>
                        <span style="color:var(--muted-foreground);"><?= str_repeat('★', 5 - $r['rating']); ?></span>
                    </div>
                    <span style="font-size:0.75rem; color:var(--muted-foreground);"><?= e($r['model_id']); ?> · <?= e(date('j M Y', strtotime($r['created_at']))); ?></span>
                </div>
                <p style="margin-top:0.5rem; font-size:0.875rem;"><?= e($r['comment']); ?></p>
                <form method="POST" style="margin-top:0.75rem; display:flex; gap:0.5rem;">
                    <input type="hidden" name="csrf" value="<?= e(csrf_token()); ?>">
                    <input type="hidden" name="id" value="<?= e($r['id']); ?>">
                    <?php if ($published): ?>
                    <button type="submit" name="action" value="unpublish" class="btn btn-outline btn-sm">Unpublish</button>
                    <?php else: ?>
                    <button type="submit" name="action" value="approve" class="btn btn-primary btn-sm">Approve</button>
                    <?php endif; ?>
                    <button type="submit" name="action" value="delete" class="btn btn-outline btn-sm" onclick="return confirm('Hapus review ini?')" style="color:var(--destructive); border-color:var(--destructive);">Hapus</button>
                </form>
            </div>
        <?php endforeach; endif; ?>
        </div>
    </main>
</div>
</body>
</html>
