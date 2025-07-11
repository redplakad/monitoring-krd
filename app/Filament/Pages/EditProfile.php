<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\DataKaryawan;
use App\Models\Branch;
use Filament\Notifications\Notification;
use Spatie\Permission\Models\Role;

class EditProfile extends Page
{
    use WithFileUploads;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $title = 'Edit Profile';
    protected static string $view = 'filament.pages.edit-profile';
    protected static bool $shouldRegisterNavigation = false;
    
    public $user;
    public $isAdmin = false;
    
    // Personal Information
    public $name = '';
    public $email = '';
    public $avatar = '';
    public $cover_image = '';
    
    // Data Karyawan
    public $nik = '';
    public $no_telepon = '';
    public $no_wa = '';
    public $kode_ao = '';
    public $branch_id = '';
    public $position_id = '';
    
    // Security
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';
    
    // Options
    public $branches = [];
    public $roles = [];
    public $selectedRoles = [];

    public function mount()
    {
        $this->user = Auth::user()->load(['dataKaryawan.position', 'dataKaryawan.branch', 'roles']);
        
        // Check if user is administrator
        $this->isAdmin = $this->user->hasRole('administrator') || $this->user->hasRole('admin');
        
        // Populate form with current user data
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->avatar = $this->user->avatar ?? '';
        $this->cover_image = $this->user->cover_image ?? '';
        
        if ($this->user->dataKaryawan) {
            $this->nik = $this->user->dataKaryawan->nik ?? '';
            $this->no_telepon = $this->user->dataKaryawan->no_telepon ?? '';
            $this->no_wa = $this->user->dataKaryawan->no_wa ?? '';
            $this->kode_ao = $this->user->dataKaryawan->kode_ao ?? '';
            $this->branch_id = $this->user->dataKaryawan->branch_id ?? '';
            $this->position_id = $this->user->dataKaryawan->position_id ?? '';
        }
        
        // Load options
        $this->branches = Branch::all();
        $this->roles = Role::all();
        $this->selectedRoles = $this->user->roles->pluck('id')->toArray();
    }
    
    public function updatePersonalInfo()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
        ]);
        
        try {
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            
            Notification::make()
                ->title('Informasi personal berhasil diperbarui')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal memperbarui informasi personal')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
    
    public function updateEmployeeData()
    {
        $this->validate([
            'nik' => 'nullable|string|max:20',
            'no_telepon' => 'nullable|string|max:15',
            'no_wa' => 'nullable|string|max:15',
            'kode_ao' => 'nullable|string|max:10',
            'branch_id' => 'nullable|exists:branches,id',
            'position_id' => 'nullable|exists:positions,id',
        ]);
        
        try {
            $updateData = [
                'nik' => $this->nik,
                'no_telepon' => $this->no_telepon,
                'no_wa' => $this->no_wa,
                'email' => $this->email,
            ];
            
            // Only admin can update these fields
            if ($this->isAdmin) {
                $updateData['kode_ao'] = $this->kode_ao;
                $updateData['branch_id'] = $this->branch_id;
                $updateData['position_id'] = $this->position_id;
            }
            
            DataKaryawan::updateOrCreate(
                ['user_id' => $this->user->id],
                $updateData
            );
            
            // Only admin can update roles
            if ($this->isAdmin) {
                $this->user->syncRoles($this->selectedRoles);
            }
            
            Notification::make()
                ->title('Data karyawan berhasil diperbarui')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal memperbarui data karyawan')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
    
    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        
        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Password saat ini tidak sesuai.');
            return;
        }
        
        try {
            $this->user->update([
                'password' => Hash::make($this->password)
            ]);
            
            $this->reset(['current_password', 'password', 'password_confirmation']);
            
            Notification::make()
                ->title('Password berhasil diperbarui')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal memperbarui password')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
    
    public function uploadAvatar()
    {
        $this->validate([
            'avatar' => 'required|image|max:2048', // 2MB max
        ]);
        
        try {
            // Delete old avatar if exists
            if ($this->user->avatar) {
                Storage::disk('public')->delete($this->user->avatar);
            }
            
            // Store new avatar
            $path = $this->avatar->store('avatars', 'public');
            
            $this->user->update(['avatar' => $path]);
            
            Notification::make()
                ->title('Avatar berhasil diperbarui')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal memperbarui avatar')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
    
    public function uploadCoverImage()
    {
        $this->validate([
            'cover_image' => 'required|image|max:5120', // 5MB max
        ]);
        
        try {
            // Delete old cover image if exists
            if ($this->user->cover_image) {
                Storage::disk('public')->delete($this->user->cover_image);
            }
            
            // Store new cover image
            $path = $this->cover_image->store('covers', 'public');
            
            $this->user->update(['cover_image' => $path]);
            
            Notification::make()
                ->title('Cover image berhasil diperbarui')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal memperbarui cover image')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
    
    public function backToProfile()
    {
        return redirect()->route('filament.admin.pages.user-profile');
    }
}
