<?php

namespace App\Filament\Resources\MonitoringKreditResource\Pages;

use App\Filament\Resources\MonitoringKreditResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListMonitoringKredits extends ListRecords
{
    protected static string $resource = MonitoringKreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->mutateFormDataUsing(function (array $data): array {
                $data['user_id'] = Auth::id();

                return $data;
            }),
        ];
    }
}
