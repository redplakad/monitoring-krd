<?php

namespace App\Filament\Resources\NominatifKreditResource\Pages;

use App\Filament\Resources\NominatifKreditResource;
use App\Filament\Imports\NominatifKreditImporter;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListNominatifKredits extends ListRecords
{
    protected static string $resource = NominatifKreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
