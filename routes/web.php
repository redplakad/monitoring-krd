<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/user-profile/{id?}', \App\Filament\Pages\UserProfile::class)
    ->name('filament.admin.pages.user-profile');