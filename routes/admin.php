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
use App\Livewire\Admin\Members\Index as MemberIndex;
use App\Livewire\Admin\Members\Editor as MemberEditor;
use App\Livewire\Admin\Galleries\Index as GalleryIndex;
use App\Livewire\Admin\Galleries\Editor as GalleryEditor;
use App\Livewire\Admin\Faqs\Index as FaqIndex;
use App\Livewire\Admin\Faqs\Editor as FaqEditor;

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

        // Member Management
        Route::get('/members', MemberIndex::class)->name('members.index');
        Route::get('/members/create', MemberEditor::class)->name('members.create');
        Route::get('/members/edit/{uuid}', MemberEditor::class)->name('members.edit');

        // Gallery Management
        Route::get('/galleries', GalleryIndex::class)->name('galleries.index');
        Route::get('/galleries/create', GalleryEditor::class)->name('galleries.create');
        Route::get('/galleries/edit/{uuid}', GalleryEditor::class)->name('galleries.edit');

        // FAQ Management
        Route::get('/faqs', FaqIndex::class)->name('faqs.index');
        Route::get('/faqs/create', FaqEditor::class)->name('faqs.create');
        Route::get('/faqs/edit/{id}', FaqEditor::class)->name('faqs.edit');

        // Logout
        Route::post('/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('admin.login');
        })->name('logout');
    });
});
