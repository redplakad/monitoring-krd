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

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationGroup = 'Kredit';
    protected static ?string $navigationLabel = 'Penagihan Kredit';
    protected static ?string $pluralModelLabel = 'Penagihan Kredit';
    protected static ?string $modelLabel = 'Penagihan Kredit';
    protected static ?string $slug = 'monitoring-kredits';
    protected static ?string $label = 'Penagihan Kredit';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('CIF')
                    ->label('CIF')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('NOMOR_REKENING')
                    ->label('Nomor Rekening')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('NAMA_NASABAH')
                    ->label('Nama Nasabah')
                    ->maxLength(100)
                    ->default(null),
                Forms\Components\TextInput::make('TINDAKAN')
                    ->label('Tindakan')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('PEMBAYARAN')
                    ->label('Pembayaran')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\Textarea::make('HASIL_TINDAKAN')
                    ->label('Hasil Tindakan')
                    ->maxLength(1000)
                    ->default(null)
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
                    ->label('CIF')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('NOMOR_REKENING')
                    ->label('Nomor Rekening')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('NAMA_NASABAH')
                    ->label('Nama Nasabah')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('TINDAKAN')
                    ->label('Tindakan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('PEMBAYARAN')
                    ->label('Pembayaran')
                    ->formatStateUsing(fn ($state) => "Rp " . number_format($state, 0, ',', '.'))
                    ->default(0.00)
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Petugas')
                    ->searchable()
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
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
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
            //'create' => Pages\CreateMonitoringKredit::route('/create'),
            //'edit' => Pages\EditMonitoringKredit::route('/{record}/edit'),
        ];
    }
}
