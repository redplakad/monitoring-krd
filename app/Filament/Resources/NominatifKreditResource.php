<?php

namespace App\Filament\Resources;

use App\Filament\Imports\NominatifKreditImporter;
use App\Filament\Resources\NominatifKreditResource\Pages;
use App\Filament\Resources\NominatifKreditResource\RelationManagers;
use App\Models\NominatifKredit;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use App\Filament\Resources\NominatifKreditResource\Pages\DetailKredit;
use Filament\Tables\Actions\Action;

class NominatifKreditResource extends Resource
{
    protected static ?string $model = NominatifKredit::class;

    protected static ?string $navigationIcon = "heroicon-o-clipboard-document-list";
    protected static ?string $navigationGroup = "Kredit";  
    protected static ?string $navigationLabel = "Nominatif Kredit";
    protected static ?string $label = "Nominatif Kredit";
    protected static ?string $pluralLabel = "Nominatif Kredit";
    protected static ?string $slug = "nominatif-kredits";
    

    public static function form(Form $form): Form
    {
        return $form->schema([
            //
        ]);
    }

        public static function infolist(Infolist $infolist): Infolist
        {
            return $infolist
                ->schema([
                Infolists\Components\TextEntry::make('POKOK_PINJAMAN')
                            ->label('Bakidebet')->money('IDR'),
                    Infolists\Components\TextEntry::make('KODE_KOLEK')
                            ->label('Kol'),
                    Infolists\Components\TextEntry::make('NAMA_NASABAH')
                            ->label('Nama Debitur')
                        ->columnSpanFull(),
                ]);
        }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()->importer(NominatifKreditImporter::class),
            ])
            ->columns([
                //
                //Tables\Columns\TextColumn::make("DATADATE")->label("Datadate"),
                Tables\Columns\TextColumn::make("NOMOR_REKENING")->label(
                    "No Rekening"
                ),
                Tables\Columns\TextColumn::make("NAMA_NASABAH")
                    ->label("Nama Debitur")
                    ->searchable(),
                Tables\Columns\TextColumn::make("KODE_KOLEK")->label("KOL"),
                Tables\Columns\TextColumn::make("JML_HARI_TUNGGAKAN")->label(
                    "Durasi"
                ),
                Tables\Columns\TextColumn::make("KET_KD_PRD")->label("Produk"),
                Tables\Columns\TextColumn::make("TGL_PK")
                    ->label("Tgl Cair")
                    ->date(),
                Tables\Columns\TextColumn::make("POKOK_PINJAMAN")
                    ->label("Bakidebet")
                    ->money("IDR"),
            ])
            ->filters([
                Filter::make("ao_filter")
                    ->label("Filter Berdasarkan AO")
                    ->form([
                        Select::make("ao_name")
                            ->label("Pilih AO")
                            ->placeholder("Pilih atau cari AO")
                            ->options(function () {
                                // Ambil daftar AO unik dari database
                                return \App\Models\NominatifKredit::query()
                                    ->whereNotNull("AO")
                                    ->where("AO", "<>", "")
                                    ->pluck("AO", "AO")
                                    ->map(fn($ao) => $ao)
                                    ->unique()
                                    ->sort()
                                    ->toArray();
                            })
                            ->searchable()
                            ->required(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data["ao_name"],
                            fn(Builder $query, $aoName) => $query->where(
                                "AO",
                                $aoName
                            )
                        );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data["ao_name"]) {
                            return null;
                        }

                        return "AO: {$data["ao_name"]}";
                    }),
                Filter::make("produk_filter")
                    ->label("Filter Berdasarkan Produk")
                    ->form([
                        Select::make("ket_kd_prd")
                            ->label("Pilih Produk")
                            ->placeholder("Pilih atau cari produk")
                            ->options(function () {
                                return \App\Models\NominatifKredit::query()
                                    ->whereNotNull("KET_KD_PRD")
                                    ->where("KET_KD_PRD", "<>", "")
                                    ->pluck("KET_KD_PRD", "KET_KD_PRD")
                                    ->map(fn($prd) => $prd)
                                    ->unique()
                                    ->sort()
                                    ->toArray();
                            })
                            ->searchable()
                            ->required(false),
                    ])
                    ->query(
                        fn(Builder $query, array $data): Builder => $data[
                            "ket_kd_prd"
                        ]
                            ? $query->where("KET_KD_PRD", $data["ket_kd_prd"])
                            : $query
                    )
                    ->indicateUsing(
                        fn(array $data): ?string => $data["ket_kd_prd"]
                            ? "Produk: {$data["ket_kd_prd"]}"
                            : null
                    ),
                Filter::make("kode_kolek_filter")
                    ->label("Filter Berdasarkan Status Kolektibilitas")
                    ->form([
                        Select::make("kode_kolek")
                            ->label("Pilih Status Kolektibilitas")
                            ->placeholder("Pilih status kolektibilitas")
                            ->options([
                                "1" => "Lancar",
                                "2" => "Dalam Perhatian Khusus",
                                "3" => "Kurang Lancar",
                                "4" => "Diragukan",
                                "5" => "Macet",
                            ])
                            ->required(false),
                    ])
                    ->query(
                        fn(Builder $query, array $data): Builder => isset(
                            $data["kode_kolek"]
                        ) && $data["kode_kolek"] !== null
                            ? $query->where("KODE_KOLEK", $data["kode_kolek"])
                            : $query
                    )
                    ->indicateUsing(
                        fn(array $data): ?string => match (
                        $data["kode_kolek"] ?? null
                        ) {
                            "1" => "Status: Lancar",
                            "2" => "Status: Dalam Perhatian Khusus",
                            "3" => "Status: Kurang Lancar",
                            "4" => "Status: Diragukan",
                            "5" => "Status: Macet",
                            default => null,
                        }
                    ),
            ])
            ->actions([
                Action::make('lihat_detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->url(fn (NominatifKredit $record): string => route('filament.admin.resources.nominatif-kredits.detail', ['record' => sha1($record->id)]))
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
            "index" => Pages\ListNominatifKredits::route("/"),
            //'create' => Pages\CreateNominatifKredit::route('/create'),
            //'edit' => Pages\EditNominatifKredit::route('/{record}/edit'),
            //'view' => ViewNominatifKredit::route('/{record}'),
            'detail' => DetailKredit::route('/{record}/detail'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        // Ambil max DATADATE dari model
        $latestDate = static::getModel()
            ::query()
            ->max("DATADATE");

        return parent::getEloquentQuery()->when(
            $latestDate,
            fn($query) => $query->where("DATADATE", $latestDate)
        );
    }
}
