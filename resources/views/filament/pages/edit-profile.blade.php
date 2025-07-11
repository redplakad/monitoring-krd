<x-filament::page>
    <div class="space-y-8">
        
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow p-6 mb-6" style="margin-bottom: 1rem;">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-success-100 rounded-full">
                        <svg class="w-6 h-6 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Profile</h1>
                        <p class="text-gray-600">Kelola informasi profil dan pengaturan akun Anda</p>
                    </div>
                </div>
                <x-filament::button color="gray" icon="heroicon-o-arrow-left" wire:click="backToProfile">
                    Kembali ke Profile
                </x-filament::button>
            </div>
        </div>

        <!-- Section 1: Cover & Avatar -->
        <div class="bg-white rounded-xl shadow overflow-hidden mb-6" style="margin-bottom: 1rem;">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Cover & Avatar
                </h2>
                <p class="text-sm text-gray-600 mt-1">Atur foto profil dan gambar latar belakang</p>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <!-- Cover Image Upload -->
                    <div class="space-y-4">
                        <h3 class="font-medium text-gray-900">Cover Image</h3>
                        <div class="relative">
                            <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-lg overflow-hidden">
                                @if($user->cover_image)
                                    <img src="{{ asset('storage/' . $user->cover_image) }}" alt="Cover" class="w-full h-32 object-cover">
                                @else
                                    <div class="w-full h-32 bg-gradient-to-r from-success-400 to-success-600 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-2">
                            <input type="file" wire:model="cover_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-success-50 file:text-success-700 hover:file:bg-success-100">
                            @error('cover_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            <x-filament::button color="success" wire:click="uploadCoverImage" size="sm" :disabled="!$cover_image">
                                Upload Cover
                            </x-filament::button>
                        </div>
                    </div>
                    
                    <!-- Avatar Upload -->
                    <div class="space-y-4">
                        <h3 class="font-medium text-gray-900">Avatar</h3>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-md">
                                @else
                                    <div class="w-20 h-20 rounded-full bg-success-100 flex items-center justify-center border-4 border-white shadow-md">
                                        <svg class="w-8 h-8 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-2">
                                <input type="file" wire:model="avatar" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-success-50 file:text-success-700 hover:file:bg-success-100">
                                @error('avatar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                <x-filament::button color="success" wire:click="uploadAvatar" size="sm" :disabled="!$avatar">
                                    Upload Avatar
                                </x-filament::button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Section 2: Personal Information -->
        <div class="bg-white rounded-xl shadow overflow-hidden mb-6" style="margin-bottom: 1rem;">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Personal
                </h2>
                <p class="text-sm text-gray-600 mt-1">Informasi dasar tentang diri Anda</p>
            </div>
            
            <div class="p-6">
                <form wire:submit.prevent="updatePersonalInfo">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" wire:model="name" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" wire:model="email" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <x-filament::button color="success" type="submit" icon="heroicon-o-check">
                            Simpan Informasi Personal
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Section 3: Data Karyawan -->
        <div class="bg-white rounded-xl shadow overflow-hidden mb-6" style="margin-bottom: 1rem;">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h8z"></path>
                    </svg>
                    Data Karyawan
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Informasi yang berkaitan dengan pekerjaan dan jabatan
                    @if(!$isAdmin)
                        <br><span class="text-amber-600 font-medium">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            Beberapa field hanya dapat diubah oleh administrator
                        </span>
                    @endif
                </p>
            </div>
            
            <div class="p-6">
                <form wire:submit.prevent="updateEmployeeData">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- NIK -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                            <input type="text" wire:model="nik" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500">
                            @error('nik') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Kode AO -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kode AO
                                @if(!$isAdmin)
                                    <span class="text-xs text-gray-500">(Hanya Administrator)</span>
                                @endif
                            </label>
                            <input type="text" wire:model="kode_ao" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500 {{ !$isAdmin ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                {{ !$isAdmin ? 'disabled' : '' }}>
                            @error('kode_ao') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            @if(!$isAdmin)
                                <p class="text-xs text-gray-500 mt-1">Hanya administrator yang dapat mengubah kode AO</p>
                            @endif
                        </div>

                        <!-- No. Telepon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                            <input type="text" wire:model="no_telepon" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500">
                            @error('no_telepon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- No. WhatsApp -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp</label>
                            <input type="text" wire:model="no_wa" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500">
                            @error('no_wa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Branch -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Cabang
                                @if(!$isAdmin)
                                    <span class="text-xs text-gray-500">(Hanya Administrator)</span>
                                @endif
                            </label>
                            <select wire:model="branch_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500 {{ !$isAdmin ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                {{ !$isAdmin ? 'disabled' : '' }}>
                                <option value="">Pilih Cabang</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->nama ?? $branch->name }}</option>
                                @endforeach
                            </select>
                            @error('branch_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            @if(!$isAdmin)
                                <p class="text-xs text-gray-500 mt-1">Hanya administrator yang dapat mengubah cabang</p>
                            @endif
                        </div>

                        <!-- Roles -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Role
                                @if(!$isAdmin)
                                    <span class="text-xs text-gray-500">(Hanya Administrator)</span>
                                @endif
                            </label>
                            <div class="space-y-2 {{ !$isAdmin ? 'opacity-50' : '' }}">
                                @foreach($roles as $role)
                                    <label class="flex items-center {{ !$isAdmin ? 'cursor-not-allowed' : '' }}">
                                        <input type="checkbox" wire:model="selectedRoles" value="{{ $role->id }}" 
                                            class="rounded border-gray-300 text-success-600 shadow-sm focus:border-success-300 focus:ring focus:ring-success-200 focus:ring-opacity-50 {{ !$isAdmin ? 'cursor-not-allowed' : '' }}"
                                            {{ !$isAdmin ? 'disabled' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('selectedRoles') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            @if(!$isAdmin)
                                <p class="text-xs text-gray-500 mt-1">Hanya administrator yang dapat mengubah role</p>
                            @endif
                        </div>
                        
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <x-filament::button color="success" type="submit" icon="heroicon-o-check">
                            Simpan Data Karyawan
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Section 4: Security -->
        <div class="bg-white rounded-xl shadow overflow-hidden mb-6" style="margin-bottom: 1rem;">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Keamanan
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola password dan pengaturan keamanan akun</p>
            </div>
            
            <div class="p-6">
                <form wire:submit.prevent="updatePassword">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <!-- Current Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                            <input type="password" wire:model="current_password" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500">
                            @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                            <input type="password" wire:model="password" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500">
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                            <input type="password" wire:model="password_confirmation" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500">
                            @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <x-filament::button color="success" type="submit" icon="heroicon-o-check">
                            Update Password
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-filament::page>
