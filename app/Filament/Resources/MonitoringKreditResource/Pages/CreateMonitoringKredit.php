<?php

namespace App\Filament\Resources\MonitoringKreditResource\Pages;

use App\Filament\Resources\MonitoringKreditResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMonitoringKredit extends CreateRecord
{
    protected static string $resource = MonitoringKreditResource::class;

        protected function mutateFormDataBeforeCreate(array $data): array
        {
            $data['user_id'] = auth()->id();
            return $data;
        }
}
