<?php
/** Admin leads — list, filter, update status, delete */
require_once __DIR__ . '/../includes/page-shell.php';
admin_require_login();

$pdo = db();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';
    if ($id && csrf_check($_POST['csrf'] ?? null)) {
        if ($action === 'update_status') {
            $status = $_POST['status'] ?? 'new';
            if (in_array($status, ['new', 'contacted', 'closed', 'spam'], true)) {
                $stmt = $pdo->prepare("UPDATE leads SET status = ? WHERE id = ?");
                $stmt->execute([$status, $id]);
            }
        } elseif ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM leads WHERE id = ?");
            $stmt->execute([$id]);
        }
    }
    header('Location: /admin/leads.php');
    exit;
}

// Filter
$status = $_GET['status'] ?? '';
$where = $status ? "WHERE status = " . $pdo->quote($status) : '';
$search = trim($_GET['q'] ?? '');
if ($search) {
    $where .= ($where ? ' AND ' : 'WHERE ') . "(name LIKE ? OR phone LIKE ? OR message LIKE ?)";
    $params = ["%$search%", "%$search%", "%$search%"];
} else {
    $params = [];
}

$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 25;
$offset = ($page - 1) * $perPage;

$sql = "SELECT * FROM leads $where ORDER BY created_at DESC LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$leads = $stmt->fetchAll();

$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM leads $where");
$totalStmt->execute($params);
$total = (int)$totalStmt->fetchColumn();
$pages = (int)ceil($total / $perPage);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Leads — Admin Pusat Geely</title>
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
    <style>
        .admin-layout { display:grid; grid-template-columns:240px 1fr; min-height:100vh; }
        .admin-sidebar { background:var(--card); border-right:1px solid var(--border); padding:1.5rem 1rem; }
        .admin-sidebar a { display:block; padding:0.625rem 0.875rem; border-radius:var(--radius-md); font-size:0.875rem; color:var(--muted-foreground); margin-bottom:0.25rem; text-decoration:none; }
        .admin-sidebar a:hover, .admin-sidebar a.active { background:var(--muted); color:var(--foreground); }
        .admin-main { padding:2rem; overflow-x:auto; }
        .lead-card { background:var(--card); border:1px solid var(--border); border-radius:var(--radius-md); padding:1rem; margin-bottom:0.75rem; }
        @media (max-width: 767px) { .admin-layout { grid-template-columns:1fr; } .admin-sidebar { display:none; } }
    </style>
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar">
        <a href="/admin/index.php">📊 Dashboard</a>
        <a href="/admin/leads.php" class="active">📝 Leads</a>
        <a href="/admin/reviews.php">⭐ Reviews</a>
        <a href="/admin/export.php">📥 Export CSV</a>
        <a href="/" target="_blank">🌐 Lihat Website</a>
        <a href="/admin/logout.php">🚪 Logout</a>
    </aside>
    <main class="admin-main">
        <h1 class="font-display" style="font-size:1.875rem; font-weight:800;">Leads</h1>
        <p style="color:var(--muted-foreground); margin-top:0.25rem;"><?= $total; ?> total leads.</p>

        <!-- Filters -->
        <form method="GET" style="margin-top:1.5rem; display:flex; gap:0.5rem; flex-wrap:wrap; align-items:center;">
            <input type="search" class="input" name="q" value="<?= e($search); ?>" placeholder="Cari nama/telp/pesan..." style="max-width:24rem;">
            <select class="select" name="status" style="max-width:12rem;">
                <option value="">Semua Status</option>
                <option value="new" <?= $status === 'new' ? 'selected' : ''; ?>>Baru</option>
                <option value="contacted" <?= $status === 'contacted' ? 'selected' : ''; ?>>Dihubungi</option>
                <option value="closed" <?= $status === 'closed' ? 'selected' : ''; ?>>Closed</option>
                <option value="spam" <?= $status === 'spam' ? 'selected' : ''; ?>>Spam</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            <a href="/admin/leads.php" class="btn btn-outline btn-sm">Reset</a>
            <a href="/admin/export.php" class="btn btn-outline btn-sm">📥 Export CSV</a>
        </form>

        <!-- Leads list -->
        <div style="margin-top:1.5rem;">
        <?php if (empty($leads)): ?>
            <div class="card" style="text-align:center; color:var(--muted-foreground);">Tidak ada leads ditemukan.</div>
        <?php else: foreach ($leads as $lead): ?>
            <div class="lead-card">
                <div style="display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap; align-items:baseline;">
                    <div>
                        <strong style="font-size:1rem;"><?= e($lead['name']); ?></strong>
                        <span class="badge badge-<?= $lead['status'] === 'new' ? 'warning' : ($lead['status'] === 'contacted' ? 'info' : 'outline'); ?>" style="margin-left:0.5rem;"><?= e($lead['status']); ?></span>
                    </div>
                    <span style="font-size:0.75rem; color:var(--muted-foreground);"><?= e(date('j M Y, H:i', strtotime($lead['created_at']))); ?></span>
                </div>
                <div style="margin-top:0.5rem; font-size:0.875rem; display:grid; grid-template-columns:repeat(auto-fit, minmax(120px, 1fr)); gap:0.5rem;">
                    <div><span style="color:var(--muted-foreground); font-size:0.75rem;">Telp:</span><br><a href="https://wa.me/<?= e(preg_replace('/[^0-9]/', '', $lead['phone'])); ?>" target="_blank" style="color:var(--whatsapp);"><?= e($lead['phone']); ?></a></div>
                    <div><span style="color:var(--muted-foreground); font-size:0.75rem;">Model:</span><br><?= e(strtoupper($lead['model'] ?: '—')); ?></div>
                    <div><span style="color:var(--muted-foreground); font-size:0.75rem;">Minat:</span><br><?= e($lead['interest']); ?></div>
                    <div><span style="color:var(--muted-foreground); font-size:0.75rem;">Area:</span><br><?= e($lead['area'] ?: '—'); ?></div>
                    <?php if ($lead['preferred_date']): ?>
                    <div><span style="color:var(--muted-foreground); font-size:0.75rem;">Tanggal Pref:</span><br><?= e($lead['preferred_date']); ?></div>
                    <?php endif; ?>
                </div>
                <?php if ($lead['message']): ?>
                <p style="margin-top:0.5rem; padding:0.625rem; background:var(--muted); border-radius:var(--radius-sm); font-size:0.8125rem;"><?= e($lead['message']); ?></p>
                <?php endif; ?>

                <form method="POST" style="margin-top:0.75rem; display:flex; gap:0.5rem; flex-wrap:wrap;">
                    <input type="hidden" name="csrf" value="<?= e(csrf_token()); ?>">
                    <input type="hidden" name="id" value="<?= e($lead['id']); ?>">
                    <select name="status" class="select" style="height:2.25rem; max-width:10rem; font-size:0.8125rem;">
                        <option value="new" <?= $lead['status'] === 'new' ? 'selected' : ''; ?>>Baru</option>
                        <option value="contacted" <?= $lead['status'] === 'contacted' ? 'selected' : ''; ?>>Dihubungi</option>
                        <option value="closed" <?= $lead['status'] === 'closed' ? 'selected' : ''; ?>>Closed</option>
                        <option value="spam" <?= $lead['status'] === 'spam' ? 'selected' : ''; ?>>Spam</option>
                    </select>
                    <button type="submit" name="action" value="update_status" class="btn btn-primary btn-sm">Update</button>
                    <button type="submit" name="action" value="delete" class="btn btn-outline btn-sm" onclick="return confirm('Hapus lead ini?')" style="color:var(--destructive); border-color:var(--destructive);">Hapus</button>
                </form>
            </div>
        <?php endforeach; endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($pages > 1): ?>
        <div style="margin-top:1.5rem; display:flex; justify-content:center; gap:0.25rem;">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?page=<?= $i; ?>&status=<?= e($status); ?>&q=<?= e($search); ?>" class="btn <?= $i === $page ? 'btn-primary' : 'btn-outline'; ?> btn-sm"><?= $i; ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </main>
</div>
</body>
</html>
