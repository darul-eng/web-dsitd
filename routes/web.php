
<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\Home;
use App\Livewire\Public\ProfileHistory;
use App\Livewire\Public\ProfileOrganization;
use App\Livewire\Public\ProfileVisionMission;
use App\Livewire\Public\ServiceShow;
use App\Livewire\Public\ServicesIndex;
use App\Livewire\Public\ProfileOrganizationV2;
use App\Livewire\Public\NewsIndex;
use App\Livewire\Public\DocumentsIndex;
use App\Livewire\Public\GalleryIndex;
use App\Livewire\Public\NewsShow;



Route::get('/', Home::class)->name('home');
Route::get('/profil/visi-misi', ProfileVisionMission::class)->name('profile.vision-mission');
Route::get('/profil/sejarah', ProfileHistory::class)->name('profile.history');
Route::get('/profil/struktur-organisasi', ProfileOrganization::class)->name('profile.organization');

// Placeholder for other public pages
Route::get('/layanan', ServicesIndex::class)->name('services.index');
Route::get('/layanan/{service:slug}', ServiceShow::class)->name('services.show');
Route::get('/warta', NewsIndex::class)->name('news.index');
Route::get('/warta/{news:slug}', NewsShow::class)->name('news.show');
Route::get('/dokumen', DocumentsIndex::class)->name('documents.index');
Route::get('/galeri', GalleryIndex::class)->name('gallery.index');


require __DIR__.'/admin.php';
