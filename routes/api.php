<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactMessageController;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\SettingController;

// ─── Public API ───────────────────────────────────────────────
Route::post('/submit', [APIController::class, 'submit']);
Route::post('/contact', [ContactMessageController::class, 'store']);
