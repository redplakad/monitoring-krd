<?php

namespace App\Filament\Resources\MonitoringKreditResource\Pages;

use App\Filament\Resources\MonitoringKreditResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonitoringKredit extends EditRecord
{
    protected static string $resource = MonitoringKreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
