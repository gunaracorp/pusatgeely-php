<?php
/** Export leads as CSV */
require_once __DIR__ . '/../includes/page-shell.php';
admin_require_login();

$pdo = db();

// Filter (same as leads page)
$status = $_GET['status'] ?? '';
$where = $status ? "WHERE status = " . $pdo->quote($status) : '';

$stmt = $pdo->query("SELECT id, name, phone, model, interest, area, preferred_date, message, lang, source, status, ip, created_at FROM leads $where ORDER BY created_at DESC");
$leads = $stmt->fetchAll();

$filename = 'pusatgeely-leads-' . date('Y-m-d-His') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: no-store, no-cache, must-revalidate');

$out = fopen('php://output', 'w');
// BOM for Excel UTF-8 detection
fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
// Header row
fputcsv($out, ['ID', 'Nama', 'WhatsApp', 'Model', 'Minat', 'Area', 'Tanggal Pref', 'Pesan', 'Bahasa', 'Source', 'Status', 'IP', 'Created At']);
// Data rows
foreach ($leads as $l) {
    fputcsv($out, $l);
}
fclose($out);
