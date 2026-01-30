<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Home;

Route::get('/', Home::class)->name('home');

// Placeholder for other public pages
Route::get('/layanan/{slug}', function($slug) { return "Layanan: $slug"; })->name('services.show');
Route::get('/warta/{slug}', function($slug) { return "Warta: $slug"; })->name('news.show');

require __DIR__.'/admin.php';
