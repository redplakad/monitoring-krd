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

    public function mount($id = null)
    {
        if ($id) {
            // Cari user berdasarkan hash sha1(id)
            $user = \App\Models\User::all()->first(function ($u) use ($id) {
                return sha1($u->id) === $id;
            });
            if ($user) {
                $this->user = $user->load(['dataKaryawan.position', 'dataKaryawan.branch']);
            } else {
                abort(404, 'User tidak ditemukan.');
            }
        } else {
            $this->user = \App\Models\User::with(['dataKaryawan.position', 'dataKaryawan.branch'])->find(Auth::id());
        }
    }
}
