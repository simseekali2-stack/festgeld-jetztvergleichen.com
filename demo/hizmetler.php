<?php
require_once 'admin/db.php';
require_once 'inc/api.php';

// Fetch services
$stmt = $pdo->query("SELECT * FROM services ORDER BY created_at DESC");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

$head_title = "Dienstleistungen";
include 'layout/header.php';
?>
    <!-- Page Content -->
    <main class="flex-grow container mx-auto px-4 py-12 md:py-20">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-5xl font-bold text-blue-900 mb-4">Professionelle Dienstleistungen</h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Entdecken Sie unsere professionellen Beratungs- und Vergleichsdienste für Ihre finanziellen Ziele.</p>
        </div>

        <?php if (count($services) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($services as $service): ?>
                    <a href="dienstleistung/<?= htmlspecialchars($service['slug']) ?>" class="group bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden flex flex-col text-center">
                        <div class="h-2 bg-gradient-to-r from-blue-600 to-indigo-500"></div>
                        <div class="p-8 flex items-center flex-grow flex-col">
                            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3"><?= htmlspecialchars($service['title']) ?></h3>
                            <p class="text-gray-500 text-sm line-clamp-3">
                                <?= strip_tags($service['content']) ?>
                            </p>
                        </div>
                        <div class="px-8 py-4 border-t border-gray-100 mt-auto flex items-center justify-between text-blue-600 font-semibold text-sm group-hover:bg-blue-50 transition-colors">
                            <span>Details ansehen</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center text-gray-500 py-12">Noch keine Dienstleistungen hinzugefügt.</div>
        <?php endif; ?>
    </main>
<?php include 'layout/footer.php'; ?>
