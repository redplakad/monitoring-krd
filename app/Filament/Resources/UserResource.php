<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Branch;
use App\Models\Position;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administrator';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('User')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->required(), 
                    Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(), 
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context) => $context === 'create')
                        ->label('Password'),
                    Forms\Components\Select::make('role')
                        ->label('Role')
                        ->options(Role::all()->pluck('name', 'name'))
                        ->required()
                        ->searchable(), 
                ])
                ->columns(2),

            Forms\Components\Section::make('Data Karyawan')
                ->schema([
                    Forms\Components\TextInput::make('nik')
                        ->label('NIK')
                        ->unique(ignoreRecord: true)
                        ->required(), 
                    Forms\Components\Select::make('branch_id')
                        ->label('Branch')
                        ->options(Branch::all()->pluck('nama', 'id'))
                        ->searchable()
                        ->required(), 
                    Forms\Components\Select::make('position_id')
                        ->label('Position')->options(Position::all()->pluck('nama', 'id'))->searchable()->required(), 
                    Forms\Components\Select::make('kode_ao')
                        ->label('Kode AO')
                        ->options(function () {
                            return \App\Models\NominatifKredit::select('AO')
                                ->distinct()
                                ->whereNotNull('AO')
                                ->orderBy('AO')
                                ->pluck('AO', 'AO')
                                ->toArray();
                        })
                        ->searchable()
                        ->preload(), 
                    Forms\Components\TextInput::make('no_telepon')
                        ->label('No Telepon'), 
                    Forms\Components\TextInput::make('no_wa')
                        ->label('No WhatsApp'), 
                    Forms\Components\TextInput::make('email')
                        ->label('Email Karyawan'), 
                    Forms\Components\FileUpload::make('data_karyawan.foto_profil')
                        ->label('Foto Profil')
                        ->image()
                        ->directory('foto_karyawan')
                        ->imagePreviewHeight('100')
                        ->nullable(), 
                    Forms\Components\FileUpload::make('data_karyawan.foto_cover')
                        ->label('Foto Cover')
                        ->image()
                        ->directory('foto_karyawan')
                        ->imagePreviewHeight('100')
                        ->nullable()])
                ->columns(2)
                ->relationship('dataKaryawan'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('email_verified_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        // Jika password null atau kosong, hapus dari $data agar tidak diupdate
        if (empty($data['password'])) {
            unset($data['password']);
        }
        return $data;
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    public static function shouldRegisterNavigation(): bool
    {
        /** @var \App\Models\User|null $user */
        
        $user = Filament::auth()->user();
        return $user && method_exists($user, 'hasRole') && $user->hasRole('Administrator');
    }
}
