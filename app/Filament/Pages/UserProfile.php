<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $title = 'Profil Saya';
    protected static string $view = 'filament.pages.user-profile';

    public $user;

    public function mount()
    {
        $this->user = \App\Models\User::with(['dataKaryawan.position', 'dataKaryawan.branch'])->find(Auth::id());
    }
}
