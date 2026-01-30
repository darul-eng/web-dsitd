<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\Login;
use App\Livewire\Admin\News\Index as NewsIndex;
use App\Livewire\Admin\News\Editor as NewsEditor;
use App\Livewire\Admin\Pages\Index as PageIndex;
use App\Livewire\Admin\Pages\Editor as PageEditor;
use App\Livewire\Admin\Jumbotrons\Index as JumbotronIndex;
use App\Livewire\Admin\Links\Index as LinkIndex;
use App\Livewire\Admin\Services\Index as ServiceIndex;
use App\Livewire\Admin\Services\Editor as ServiceEditor;
use App\Livewire\Admin\Documents\Index as DocumentIndex;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Protected admin panel routes with authentication and authorization.
|
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest only (Login)
    Route::middleware('guest')->group(function () {
        Route::get('/login', Login::class)->name('login');
    });

    // Authenticated Admin only
    Route::middleware(['auth', 'role:superadmin|admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard'); // Arch suggest resources/views/admin/
        })->name('dashboard');

        // News Management
        Route::get('/news', NewsIndex::class)->name('news.index');
        Route::get('/news/create', NewsEditor::class)->name('news.create');
        Route::get('/news/edit/{uuid}', NewsEditor::class)->name('news.edit');

        // Page Management
        Route::get('/pages', PageIndex::class)->name('pages.index');
        Route::get('/pages/create', PageEditor::class)->name('pages.create');
        Route::get('/pages/edit/{uuid}', PageEditor::class)->name('pages.edit');

        // Jumbotron Management
        Route::get('/jumbotrons', JumbotronIndex::class)->name('jumbotrons.index');

        // Link Management
        Route::get('/links', LinkIndex::class)->name('links.index');

        // Service Management
        Route::get('/services', ServiceIndex::class)->name('services.index');
        Route::get('/services/create', ServiceEditor::class)->name('services.create');
        Route::get('/services/edit/{uuid}', ServiceEditor::class)->name('services.edit');

        // Document Management
        Route::get('/documents', DocumentIndex::class)->name('documents.index');

        // Logout
        Route::post('/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('admin.login');
        })->name('logout');
    });
});
