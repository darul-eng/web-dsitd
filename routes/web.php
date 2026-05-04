
<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Home;
use App\Livewire\Public\ProfileHistory;
use App\Livewire\Public\ProfileOrganization;
use App\Livewire\Public\ProfileVisionMission;
use App\Livewire\Public\ServiceShow;
use App\Livewire\Public\ServicesIndex;
use App\Livewire\Public\ProfileOrganizationV2;


Route::get('/', Home::class)->name('home');
Route::get('/profil/visi-misi', ProfileVisionMission::class)->name('profile.vision-mission');
Route::get('/profil/sejarah', ProfileHistory::class)->name('profile.history');
Route::get('/profil/struktur-organisasi', ProfileOrganization::class)->name('profile.organization');

// Placeholder for other public pages
Route::get('/layanan', ServicesIndex::class)->name('services.index');
Route::get('/layanan/{service:slug}', ServiceShow::class)->name('services.show');
Route::get('/warta/{slug}', function($slug) { return "Warta: $slug"; })->name('news.show');

require __DIR__.'/admin.php';
