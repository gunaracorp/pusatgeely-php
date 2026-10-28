<?php
/** llms-full.txt — comprehensive site content for LLMs */
require_once __DIR__ . '/includes/page-shell.php';
header('Content-Type: text/plain; charset=utf-8');

echo "# " . BUSINESS['name'] . " — LLMs-Full Reference\n\n";
echo "> Source-of-truth content for AI assistants. Last updated: " . date('Y-m-d') . "\n\n";
echo "## Business Profile\n\n";
echo "- Name: " . BUSINESS['name'] . "\n";
echo "- Tagline (ID): " . (BUSINESS['tagline_id'] ?? '') . "\n";
echo "- PIC: " . BUSINESS['pic'] . " (" . BUSINESS['role_id'] . ")\n";
echo "- WhatsApp: " . BUSINESS['wa_display'] . "\n";
echo "- Email: " . BUSINESS['email'] . "\n";
echo "- Hours: " . BUSINESS['hours_id'] . "\n";
echo "- Region: " . BUSINESS['region_id'] . "\n";
echo "- Instagram: " . BUSINESS['instagram'] . " (" . BUSINESS['instagram_url'] . ")\n";
echo "- Facebook: " . BUSINESS['facebook'] . "\n";
echo "- TikTok: " . BUSINESS['tiktok'] . "\n";
echo "- X: " . BUSINESS['x_handle'] . "\n";
echo "\n## Independence Disclaimer\n\n";
echo $INDEPENDENCE_DISCLAIMER['id'] . "\n\n";

echo "## Models — Complete Specs\n\n";
foreach ($MODELS as $m) {
    echo "### " . $m['name'] . " (" . $m['id'] . ")\n\n";
    echo "- Powertrain: " . $POWERTRAIN_LABEL[$m['powertrain']]['id'] . "\n";
    echo "- Image: " . SITE_URL . $m['image'] . "\n";
    echo "- Harga mulai: " . format_idr($m['priceFrom']) . "\n";
    echo "- Variants:\n";
    foreach ($m['variants'] as $v) {
        echo "  - " . $v['label'] . ": " . format_idr($v['price']) . "\n";
    }
    echo "- Specs kunci: " . implode('; ', array_map(fn($s) => $s['id'], $m['specs'])) . "\n";
    echo "- Blurb: " . $m['blurb']['id'] . "\n";
    if (!empty($m['colors'])) {
        echo "- Warna: " . implode(', ', array_map(fn($c) => $c['label']['id'], $m['colors'])) . "\n";
    }
    echo "- URL: " . SITE_URL . "/model/" . $m['id'] . "\n";
    echo "\n";

    // Detail
    foreach ($MODEL_DETAILS ?? [] as $d) {
        if ($d['id'] !== $m['id']) continue;
        echo "#### Tagline: " . $d['tagline']['id'] . "\n\n";
        foreach ($d['overview']['id'] as $p) echo $p . "\n\n";
        echo "#### Spec Table\n\n";
        foreach ($d['specs'] as $s) echo "- " . $s['label']['id'] . ": " . $s['value']['id'] . "\n";
        echo "\n#### Highlights\n\n";
        foreach ($d['highlights'] as $h) echo "- " . $h['id'] . "\n";
        echo "\n#### Fit For\n\n" . $d['fitFor']['id'] . "\n\n";
    }
}

echo "## FAQ\n\n";
foreach ($faqData as $f) {
    echo "### Q: " . $f['q']['id'] . "\n";
    echo "A: " . $f['a']['id'] . "\n\n";
}

echo "## Articles\n\n";
foreach ($ARTICLES as $a) {
    echo "### " . $a['title']['id'] . "\n";
    echo "- Slug: " . $a['slug'] . "\n";
    echo "- Date: " . $a['date'] . "\n";
    echo "- Tag: " . $a['tag']['id'] . "\n";
    echo "- Excerpt: " . $a['excerpt']['id'] . "\n";
    echo "- URL: " . SITE_URL . "/artikel/" . $a['slug'] . "\n\n";
}

echo "## Comparisons\n\n";
foreach ($COMPARES as $c) {
    echo "### " . ($c['title']['id'] ?? $c['slug']) . "\n";
    echo "- Slug: " . $c['slug'] . "\n";
    if (!empty($c['excerpt'])) echo "- Excerpt: " . $c['excerpt']['id'] . "\n";
    echo "- URL: " . SITE_URL . "/vs/" . $c['slug'] . "\n\n";
}

echo "## Glossary (" . count($GLOSSARY) . " terms)\n\n";
foreach ($GLOSSARY as $term) {
    echo "### " . $term['term']['id'] . " (category: " . $term['category'] . ")\n";
    echo $term['definition']['id'] . "\n\n";
}

echo "## Service Areas\n\n";
foreach ($AREAS as $area) echo "- " . $area . "\n";

echo "\n## Pricing Disclaimer\n\n" . $PRICE_DISCLAIMER['id'] . "\n";
