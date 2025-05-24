<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
    {
        if ($role = $this->data['role'] ?? null) {
            $this->record->syncRoles([$role]);
        }
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['role'] = $this->record->roles->pluck('name')->first();
        return $data;
    }
}
