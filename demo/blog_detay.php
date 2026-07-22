<?php
require_once 'admin/db.php';

$slug = isset($_GET['slug']) ? cleanString($_GET['slug']) : '';

if (empty($slug)) { header("Location: blogs"); exit; }

$stmt = $pdo->prepare("SELECT * FROM blogs WHERE slug = ?");
$stmt->execute([$slug]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) { header("HTTP/1.0 404 Not Found"); die("<h1>404 Blog nicht gefunden</h1>"); }

$head_title = !empty($blog['meta_title']) ? $blog['meta_title'] : $blog['title'];
$head_desc = !empty($blog['meta_desc']) ? $blog['meta_desc'] : substr(strip_tags($blog['content']), 0, 160);
$canonical_url = !empty($blog['canonical']) ? $blog['canonical'] : "https://{$_SERVER['HTTP_HOST']}/blog/{$blog['slug']}";
$page_depth = 0;

include 'layout/header.php';
?>
    <div class="relative py-24 md:py-32 flex items-center justify-center bg-gray-900 border-b-8 border-blue-600">
        <?php if (!empty($blog['image'])): ?>
            <div class="absolute inset-0 w-full h-full bg-cover bg-center opacity-50" style="background-image: url('../<?= htmlspecialchars($blog['image']) ?>');"></div>
        <?php endif; ?>
        <div class="container mx-auto px-4 relative z-20 text-center text-white">
            <h1 class="text-3xl md:text-5xl font-extrabold max-w-4xl mx-auto mb-6"><?= htmlspecialchars($blog['title']) ?></h1>
            <nav class="flex items-center justify-center space-x-2 text-blue-200 text-sm">
                <a href="index.php" class="hover:text-white transition">Startseite</a>
                <span>&bull;</span>
                <a href="blogs" class="hover:text-white transition">Blog</a>
            </nav>
        </div>
    </div>

    <main class="flex-grow container mx-auto px-4 py-12 md:py-20 relative z-30 -mt-10">
        <article class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 md:p-12 max-w-4xl mx-auto ck-content">
            <?= $blog['content'] ?>
        </article>
    </main>
<?php include 'layout/footer.php'; ?>
