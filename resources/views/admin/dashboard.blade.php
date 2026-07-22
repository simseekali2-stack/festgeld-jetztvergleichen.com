@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Blog Stats -->
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Toplam Blog</p>
                <p class="text-3xl font-bold text-gray-800">{{ $blogCount ?? 0 }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.blogs.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
                Blogları Yönet <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <!-- Services Stats -->
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-green-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Toplam Servis</p>
                <p class="text-3xl font-bold text-gray-800">{{ $serviceCount ?? 0 }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.services.index') }}" class="text-sm text-green-600 hover:underline flex items-center">
                Servisleri Yönet <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <!-- Pages Stats -->
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-purple-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Toplam Sayfa</p>
                <p class="text-3xl font-bold text-gray-800">{{ $pageCount ?? 0 }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.pages.index') }}" class="text-sm text-purple-600 hover:underline flex items-center">
                Sayfaları Yönet <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <!-- Contacts Stats -->
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-yellow-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Okunmamış Mesaj</p>
                <p class="text-3xl font-bold text-gray-800">{{ $contactCount ?? 0 }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.contacts.index') }}" class="text-sm text-yellow-600 hover:underline flex items-center">
                Mesajları Gör <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Hoş Geldiniz</h2>
    <p class="text-gray-600">Festgeld Vergleichen yönetim paneline hoş geldiniz. Sol menüyü kullanarak içeriklerinizi yönetebilirsiniz.</p>
</div>
@endsection
