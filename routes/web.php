<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Home;
use App\Livewire\Public\ServiceShow;
use App\Livewire\Public\ServicesIndex;

Route::get('/', Home::class)->name('home');

// Placeholder for other public pages
Route::get('/layanan', ServicesIndex::class)->name('services.index');
Route::get('/layanan/{service:slug}', ServiceShow::class)->name('services.show');
Route::get('/warta/{slug}', function($slug) { return "Warta: $slug"; })->name('news.show');

require __DIR__.'/admin.php';
