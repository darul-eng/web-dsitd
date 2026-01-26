<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\Login;

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
        Route::get('/news', \App\Livewire\Admin\News\Index::class)->name('news.index');
        Route::get('/news/create', \App\Livewire\Admin\News\Editor::class)->name('news.create');
        Route::get('/news/edit/{uuid}', \App\Livewire\Admin\News\Editor::class)->name('news.edit');

        // Logout
        Route::post('/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('admin.login');
        })->name('logout');
    });
});
