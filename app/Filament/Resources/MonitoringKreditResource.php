<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonitoringKreditResource\Pages;
use App\Filament\Resources\MonitoringKreditResource\RelationManagers;
use App\Models\MonitoringKredit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonitoringKreditResource extends Resource
{
    protected static ?string $model = MonitoringKredit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('CIF')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('NOMOR_REKENING')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('NAMA_NASABAH')
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('TINDAKAN')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('PEMBAYARAN')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\Textarea::make('HASIL_TINDAKAN')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('TAG')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('CIF')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NOMOR_REKENING')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NAMA_NASABAH')
                    ->searchable(),
                Tables\Columns\TextColumn::make('TINDAKAN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('PEMBAYARAN')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('TAG')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMonitoringKredits::route('/'),
            'create' => Pages\CreateMonitoringKredit::route('/create'),
            'edit' => Pages\EditMonitoringKredit::route('/{record}/edit'),
        ];
    }
}
