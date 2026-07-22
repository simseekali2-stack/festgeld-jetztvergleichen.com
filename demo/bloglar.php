<?php
require_once 'admin/db.php';
require_once 'inc/api.php';

// Fetch blogs
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$head_title = "Blog & News";
include 'layout/header.php';
?>
    <!-- Page Content -->
    <main class="flex-grow container mx-auto px-4 py-12 md:py-20">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-5xl font-bold text-blue-900 mb-4">Blog & News</h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Aktuelle Entwicklungen aus der Finanzwelt, Festgeldzinsen und Anlagetipps.</p>
        </div>

        <?php if (count($blogs) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($blogs as $blog): ?>
                    <article class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col border border-gray-100 group">
                        <div class="relative overflow-hidden aspect-video bg-gray-200">
                            <?php if (!empty($blog['image'])): ?>
                                <img src="<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="text-sm text-gray-500 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <?= date('d M Y', strtotime($blog['created_at'])) ?>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-blue-600 transition-colors">
                                <a href="blog/<?= htmlspecialchars($blog['slug']) ?>"><?= htmlspecialchars($blog['title']) ?></a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                                <?= strip_tags($blog['content']) ?>
                            </p>
                            <a href="blog/<?= htmlspecialchars($blog['slug']) ?>" class="inline-flex items-center text-blue-600 font-bold hover:text-blue-800 transition-colors mt-auto">
                                Weiterlesen 
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center text-gray-500 py-12">Noch keine Blogbeiträge hinzugefügt.</div>
        <?php endif; ?>
    </main>
<?php include 'layout/footer.php'; ?>
