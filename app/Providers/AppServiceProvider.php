<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        if(env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle)
                    ->middleware(['web'])
                    ->name('livewire.update');
            });
            
            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/livewire/livewire.js', $handle)
                    ->middleware(['web'])
                    ->name('livewire.js');
            });
        }
        
    }
}
