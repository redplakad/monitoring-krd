<?php

namespace App\Filament\Resources\NominatifKreditResource\Pages;

use App\Filament\Resources\NominatifKreditResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNominatifKredit extends EditRecord
{
    protected static string $resource = NominatifKreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
