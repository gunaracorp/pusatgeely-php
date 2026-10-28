<?php
/** llms.txt — concise machine-readable site overview */
require_once __DIR__ . '/includes/page-shell.php';
header('Content-Type: text/plain; charset=utf-8');

echo "# " . BUSINESS['name'] . "\n\n";
echo "> " . (BUSINESS['tagline_id'] ?? 'Partner pembelian Geely Anda di Bogor & Jabodetabek') . "\n\n";
echo "Pusat Geely adalah layanan konsultan penjualan independen untuk kendaraan Geely di Bogor & Jabodetabek. Kami bukan dealer resmi Geely — peran kami: memandu pelanggan memilih unit, mengurus penawaran, test drive, kredit, trade-in, dan mendampingi sampai serah terima. Proses pembelian berjalan melalui jaringan dealer resmi Geely Indonesia.\n\n";
echo "Konsultan: " . BUSINESS['pic'] . " (WhatsApp: " . BUSINESS['wa_display'] . ")\n";
echo "Email: " . BUSINESS['email'] . "\n";
echo "Jam layanan: " . BUSINESS['hours_id'] . "\n\n";
echo "## Models\n\n";
foreach ($MODELS as $m) {
    echo "- [" . $m['name'] . "](" . SITE_URL . "/model/" . $m['id'] . "): harga mulai " . format_idr($m['priceFrom']) . " — " . $m['blurb']['id'] . "\n";
}
echo "\n## Pages\n\n";
echo "- [Beranda](" . SITE_URL . "/)\n";
echo "- [Daftar Harga Geely Bogor](" . SITE_URL . "/harga-mobil-geely-bogor)\n";
echo "- [Promo & Paket Kredit](" . SITE_URL . "/promo-geely-bogor)\n";
echo "- [Artikel & Panduan](" . SITE_URL . "/artikel)\n";
echo "- [Perbandingan Geely vs Pesaing](" . SITE_URL . "/vs)\n";
echo "- [Glosarium Istilah EV & Kredit](" . SITE_URL . "/glosarium)\n";
echo "- [Indeks 2.600+ Kata Kunci](" . SITE_URL . "/indeks-kata-kunci)\n";
echo "- [Tentang Pusat Geely](" . SITE_URL . "/tentang)\n";
echo "- [Kontak](" . SITE_URL . "/kontak)\n";
echo "\n## Area Layanan\n\n";
foreach ($AREAS as $area) echo "- " . $area . "\n";
echo "\n## Link Penting\n\n";
echo "- Sitemap: " . SITE_URL . "/sitemap.xml\n";
echo "- RSS Feed: " . SITE_URL . "/feed.xml\n";
echo "- Lengkap: " . SITE_URL . "/llms-full.txt\n";
