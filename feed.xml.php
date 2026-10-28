<?php
/** feed.xml — RSS feed */
require_once __DIR__ . '/includes/page-shell.php';
header('Content-Type: application/rss+xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
echo '  <channel>' . "\n";
echo '    <title>' . htmlspecialchars(BUSINESS['name'] . ' — Artikel & Panduan') . '</title>' . "\n";
echo '    <link>' . SITE_URL . '</link>' . "\n";
echo '    <description>' . htmlspecialchars('Panduan jujur sebelum membeli Geely di Bogor & Jabodetabek.') . '</description>' . "\n";
echo '    <language>id-ID</language>' . "\n";
echo '    <lastBuildDate>' . date('r') . '</lastBuildDate>' . "\n";
echo '    <atom:link href="' . SITE_URL . '/feed.xml" rel="self" type="application/rss+xml" />' . "\n";

foreach ($ARTICLES as $a) {
    $url = SITE_URL . '/artikel/' . $a['slug'];
    echo '    <item>' . "\n";
    echo '      <title>' . htmlspecialchars($a['title']['id']) . '</title>' . "\n";
    echo '      <link>' . $url . '</link>' . "\n";
    echo '      <guid isPermaLink="true">' . $url . '</guid>' . "\n";
    echo '      <pubDate>' . date('r', strtotime($a['date'])) . '</pubDate>' . "\n";
    echo '      <description>' . htmlspecialchars($a['excerpt']['id']) . '</description>' . "\n";
    echo '      <category>' . htmlspecialchars($a['tag']['id']) . '</category>' . "\n";
    echo '    </item>' . "\n";
}

echo '  </channel>' . "\n";
echo '</rss>' . "\n";
