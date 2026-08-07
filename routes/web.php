<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Günlük Değişen Dinamik Admin URL'si
$adminPrefix = 'adm-' . date('j');

Route::get('/impressum', function () {
    $title = "Impressum | festgeld-jetztvergleichen.com";
    $description = "Impressum von festgeld-jetztvergleichen.com. Gesetzliche Pflichtangaben und rechtliche Hinweise zu unserem Angebot.";
    return view('pages.impressum', compact('title', 'description'));
});

Route::get('/agb', function () {
    $title = "Allgemeine Geschäftsbedingungen (AGB) | festgeld-jetztvergleichen.com";
    $description = "Allgemeine Geschäftsbedingungen und Nutzungsbedingungen von festgeld-jetztvergleichen.com.";
    return view('pages.agb', compact('title', 'description'));
});

Route::get('/datenschutz', function () {
    $title = "Datenschutzerklärung | festgeld-jetztvergleichen.com";
    $description = "Datenschutzerklärung von festgeld-jetztvergleichen.com.";
    return view('pages.datenschutz', compact('title', 'description'));
});

  
Route::get('/uploads/blogs/{filename}', function ($filename) {
    $path = storage_path('app/public/uploads/blogs/' . $filename);

    abort_unless(file_exists($path), 404);

    return Response::file($path);
});

Route::prefix($adminPrefix)->name('admin.')->middleware('throttle:60,1')->group(function () use ($adminPrefix) {

    // Admin Login Rotaları (Herkes Erişebilir)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Panel (Sadece Giriş Yapanlar)
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // Ayarlar (Settings)
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings.index');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

        // Bloglar
        Route::get('/blogs', [AdminController::class, 'blogs'])->name('blogs.index');
        Route::get('/blogs/create', [AdminController::class, 'createBlog'])->name('blogs.create');
        Route::post('/blogs', [AdminController::class, 'storeBlog'])->name('blogs.store');
        Route::get('/blogs/{id}/edit', [AdminController::class, 'editBlog'])->name('blogs.edit');
        Route::put('/blogs/{id}', [AdminController::class, 'updateBlog'])->name('blogs.update');
        Route::delete('/blogs/{id}', [AdminController::class, 'deleteBlog'])->name('blogs.destroy');

        // Servisler
        Route::get('/services', [AdminController::class, 'services'])->name('services.index');
        Route::get('/services/create', [AdminController::class, 'createService'])->name('services.create');
        Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
        Route::get('/services/{id}/edit', [AdminController::class, 'editService'])->name('services.edit');
        Route::put('/services/{id}', [AdminController::class, 'updateService'])->name('services.update');
        Route::delete('/services/{id}', [AdminController::class, 'deleteService'])->name('services.destroy');

        // Sayfalar
        Route::get('/pages', [AdminController::class, 'pages'])->name('pages.index');
        Route::get('/pages/create', [AdminController::class, 'createPage'])->name('pages.create');
        Route::post('/pages', [AdminController::class, 'storePage'])->name('pages.store');
        Route::get('/pages/{id}/edit', [AdminController::class, 'editPage'])->name('pages.edit');
        Route::put('/pages/{id}', [AdminController::class, 'updatePage'])->name('pages.update');
        Route::delete('/pages/{id}', [AdminController::class, 'deletePage'])->name('pages.destroy');

        // İletişim Mesajları
        Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts.index');
        Route::delete('/contacts/{id}', [AdminController::class, 'deleteContact'])->name('contacts.destroy');

        // Bankalar
        Route::get('/banks', [AdminController::class, 'banks'])->name('banks.index');
        Route::post('/banks/update-description', [AdminController::class, 'updateBankDescription'])->name('banks.update-description');

        // Analytics
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics.index');
    }); // auth middleware group end
}); // prefix group end

Route::get('/', [FrontendController::class, 'welcome']);
Route::get('/tagesgeld', [FrontendController::class, 'tagesgeld']);
Route::get('/banken', [FrontendController::class, 'bankIndex']);
Route::get('/blog', [FrontendController::class, 'blogIndex']);
Route::get('/blog/{slug}', [FrontendController::class, 'blogShow']);
Route::get('/services', [FrontendController::class, 'serviceIndex']);

Route::get('/sitemap.xml', [FrontendController::class, 'sitemap']);

Route::get('/kontakt', function () {
    $title = "Kontakt | Festgeld Vergleichen";
    $description = "Kontaktieren Sie uns für Fragen, Anregungen oder individuelle Beratung zu unseren Festgeld- und Tagesgeldangeboten. Wir sind für Sie da!";
    return view('pages.contact', compact('title', 'description'));
});

Route::get('/uber-uns', function () {
    $title = "Über uns | Festgeld Vergleichen";
    $description = "Erfahren Sie mehr über unser unabhängiges Team, unsere Mission und unsere Werte. Wir helfen deutschen Sparern, die besten Festgeld-Angebote zu finden.";
    return view('pages.ueber-uns', compact('title', 'description'));
});

Route::redirect('/services/festgeld-angebote', '/festgeld-angebote', 301);
Route::redirect('/services/festgeld-zinsen', '/festgeld-zinsen', 301);

// Services and Pages catch-all
Route::get('/{slug}', [FrontendController::class, 'showDynamicContent'])->where('slug', '.*');

