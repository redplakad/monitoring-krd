<?php

namespace App\Filament\Resources\NominatifKreditResource\Pages;

use App\Filament\Resources\NominatifKreditResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateNominatifKredit extends CreateRecord
{
    protected static string $resource = NominatifKreditResource::class;
}
