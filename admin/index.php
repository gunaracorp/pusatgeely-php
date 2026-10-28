<?php
/** Admin dashboard */
require_once __DIR__ . '/../includes/page-shell.php';
admin_require_login();

// Stats
$pdo = db();
$stats = [
    'leads_new' => (int)$pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'new'")->fetchColumn(),
    'leads_total' => (int)$pdo->query("SELECT COUNT(*) FROM leads")->fetchColumn(),
    'reviews_pending' => (int)$pdo->query("SELECT COUNT(*) FROM reviews WHERE published = 0")->fetchColumn(),
    'reviews_approved' => (int)$pdo->query("SELECT COUNT(*) FROM reviews WHERE published = 1")->fetchColumn(),
    'chats_today' => (int)$pdo->query("SELECT COUNT(*) FROM chat_logs WHERE created_at >= CURDATE()")->fetchColumn(),
];

$recentLeads = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Dashboard — Admin Pusat Geely</title>
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
    <style>
        .admin-layout { display:grid; grid-template-columns:240px 1fr; min-height:100vh; }
        .admin-sidebar { background:var(--card); border-right:1px solid var(--border); padding:1.5rem 1rem; }
        .admin-sidebar a { display:block; padding:0.625rem 0.875rem; border-radius:var(--radius-md); font-size:0.875rem; color:var(--muted-foreground); margin-bottom:0.25rem; }
        .admin-sidebar a:hover, .admin-sidebar a.active { background:var(--muted); color:var(--foreground); }
        .admin-main { padding:2rem; }
        .stat-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:1rem; margin-bottom:2rem; }
        .stat-card { background:var(--card); border:1px solid var(--border); border-radius:var(--radius-xl); padding:1.5rem; }
        .stat-value { font-family:var(--font-display); font-size:2.5rem; font-weight:800; color:var(--primary); }
        .stat-label { font-size:0.8125rem; color:var(--muted-foreground); margin-top:0.25rem; }
        @media (max-width: 767px) { .admin-layout { grid-template-columns:1fr; } .admin-sidebar { display:none; } }
    </style>
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar">
        <a href="/admin/index.php" class="active">📊 Dashboard</a>
        <a href="/admin/leads.php">📝 Leads (<?= $stats['leads_new'] ?> baru)</a>
        <a href="/admin/reviews.php">⭐ Reviews (<?= $stats['reviews_pending'] ?> pending)</a>
        <a href="/admin/export.php">📥 Export CSV</a>
        <a href="/" target="_blank">🌐 Lihat Website</a>
        <a href="/admin/logout.php">🚪 Logout</a>
    </aside>
    <main class="admin-main">
        <h1 class="font-display" style="font-size:1.875rem; font-weight:800;">Dashboard</h1>
        <p style="color:var(--muted-foreground); margin-top:0.25rem;">Ringkasan aktivitas Pusat Geely.</p>

        <div class="stat-grid" style="margin-top:2rem;">
            <div class="stat-card">
                <div class="stat-value"><?= $stats['leads_new']; ?></div>
                <div class="stat-label">Leads Baru</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $stats['leads_total']; ?></div>
                <div class="stat-label">Total Leads</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $stats['reviews_pending']; ?></div>
                <div class="stat-label">Review Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $stats['reviews_approved']; ?></div>
                <div class="stat-label">Review Approved</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $stats['chats_today']; ?></div>
                <div class="stat-label">Chat Hari Ini</div>
            </div>
        </div>

        <h2 class="font-display" style="font-size:1.25rem; font-weight:700; margin-top:2rem;">Leads Terbaru</h2>
        <div class="card" style="margin-top:1rem; padding:0;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--muted);">
                        <th style="padding:0.75rem 1rem; text-align:left; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);">Waktu</th>
                        <th style="padding:0.75rem 1rem; text-align:left; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);">Nama</th>
                        <th style="padding:0.75rem 1rem; text-align:left; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);">Telp</th>
                        <th style="padding:0.75rem 1rem; text-align:left; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);">Model</th>
                        <th style="padding:0.75rem 1rem; text-align:left; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($recentLeads)): ?>
                    <tr><td colspan="5" style="padding:1.5rem; text-align:center; color:var(--muted-foreground);">Belum ada leads.</td></tr>
                <?php else: foreach ($recentLeads as $lead): ?>
                    <tr style="border-top:1px solid var(--border);">
                        <td style="padding:0.75rem 1rem; font-size:0.8125rem;"><?= e(date('j M H:i', strtotime($lead['created_at']))); ?></td>
                        <td style="padding:0.75rem 1rem; font-size:0.875rem; font-weight:600;"><?= e($lead['name']); ?></td>
                        <td style="padding:0.75rem 1rem; font-size:0.8125rem;"><?= e($lead['phone']); ?></td>
                        <td style="padding:0.75rem 1rem; font-size:0.8125rem;"><?= e(strtoupper($lead['model'] ?: '—')); ?></td>
                        <td style="padding:0.75rem 1rem;">
                            <span class="badge badge-<?= $lead['status'] === 'new' ? 'warning' : ($lead['status'] === 'contacted' ? 'info' : 'outline'); ?>">
                                <?= e($lead['status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        <a href="/admin/leads.php" class="btn btn-outline" style="margin-top:1rem;">Lihat semua leads →</a>
    </main>
</div>
</body>
</html>
