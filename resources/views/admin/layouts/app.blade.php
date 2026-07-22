<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Festgeld Vergleichen</title>

    <meta name="robots" content="noindex, nofollow">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-800 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-slate-100 shrink-0">
            <span class="font-black text-lg text-slate-900">Admin Panel</span>
        </div>
        <nav class="flex-1 overflow-y-auto p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.blogs.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>Blog Posts</span>
            </a>
            <a href="{{ route('admin.services.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.services.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>Services</span>
            </a>
            <a href="{{ route('admin.pages.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.pages.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>Pages</span>
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.contacts.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>Contacts</span>
            </a>
            <a href="{{ route('admin.banks.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.banks.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>Banken</span>
            </a>
            <a href="{{ route('admin.analytics.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.analytics.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>İstatistikler</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>Settings</span>
            </a>
        </nav>
        <div class="p-4 border-t border-slate-100 shrink-0 space-y-2">
            <a href="/" target="_blank" class="w-full flex items-center justify-center gap-3 px-4 py-2 rounded-xl text-sm font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900 transition-all">
                <span>Siteyi Gör</span>
            </a>
            <form method="POST" action="{{ route('admin.logout') ?? url('/' . 'adm-' . date('j') . '/logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-2 rounded-xl text-sm font-bold bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 transition-all">
                    <span>Çıkış Yap</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6 sm:p-10">
        
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-200 font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 text-red-700 px-4 py-3 rounded-xl border border-red-200 font-bold text-sm">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
        
    </main>

    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    @stack('scripts')
</body>
</html>