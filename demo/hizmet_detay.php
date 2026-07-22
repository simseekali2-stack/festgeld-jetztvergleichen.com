<?php
require_once 'admin/db.php';

$slug = isset($_GET['slug']) ? cleanString($_GET['slug']) : '';

if (empty($slug)) { header("Location: dienstleistungen"); exit; }

$stmt = $pdo->prepare("SELECT * FROM services WHERE slug = ?");
$stmt->execute([$slug]);
$service = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$service) { header("HTTP/1.0 404 Not Found"); die("<h1>404 Dienstleistung nicht gefunden</h1>"); }

$head_title = !empty($service['meta_title']) ? $service['meta_title'] : $service['title'];
$head_desc = !empty($service['meta_desc']) ? $service['meta_desc'] : substr(strip_tags($service['content']), 0, 160);
$canonical_url = !empty($service['canonical']) ? $service['canonical'] : "https://{$_SERVER['HTTP_HOST']}/dienstleistung/{$service['slug']}";
$page_depth = 0; // Since SEF is handled by .htaccess as /dienstleistung/slug, but PHP is at root

include 'layout/header.php';
?>
    <!-- Page Banner -->
    <div class="bg-gradient-to-r from-blue-900 to-indigo-800 py-16 md:py-24 text-center text-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-5xl lg:text-5xl font-extrabold mb-6"><?= htmlspecialchars($service['title']) ?></h1>
            <nav class="flex items-center justify-center space-x-2 text-blue-200 text-sm">
                <a href="index.php" class="hover:text-white transition">Startseite</a>
                <span>/</span>
                <a href="dienstleistungen" class="hover:text-white transition">Dienstleistungen</a>
            </nav>
        </div>
    </div>

    <!-- Page Content -->
    <main class="flex-grow container mx-auto px-4 py-12 md:py-16 -mt-10 relative z-10">
        <article class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12 max-w-4xl mx-auto ck-content">
            <?= $service['content'] ?>
        </article>
    </main>
<?php include 'layout/footer.php'; ?>
