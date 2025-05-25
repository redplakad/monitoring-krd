<?php
namespace App\Filament\Pages;

use App\Filament\Widgets\UserMonitoringOverview;
use App\Filament\Widgets\UserMonitoringStats;
use App\Models\MonitoringKredit;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class UserMonitoring extends Page implements HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Laporan Penagihan';
    protected static ?string $navigationGroup = 'Kredit';
    protected static ?string $title = '';

    protected static string $view = 'filament.pages.user-monitoring';
    public $statJumlahUser;
    public $statTotalKunjungan;
    public $statTotalKomunikasi;
    public $statTotalPembayaran;

    public function mount()
    {
        $this->statJumlahUser = User::count();
        $this->statTotalKunjungan = MonitoringKredit::where('tindakan', 'kunjungan')->count();
        $this->statTotalKomunikasi = MonitoringKredit::whereIn('tindakan', ['Telepon', 'Whatsapp'])->count();
        $this->statTotalPembayaran = MonitoringKredit::sum('pembayaran');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                \App\Models\User::query()
                    ->withCount([
                        'monitoringKredit as jumlah_kunjungan' => function ($query) {
                            $query->where('tindakan', 'kunjungan');
                        },
                        'monitoringKredit as jumlah_komunikasi' => function ($query) {
                            $query->whereIn('tindakan', ['Telepon', 'Whatsapp']);
                        },
                    ])
                    ->withSum('monitoringKredit as total_pembayaran', 'pembayaran')
            )
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('dataKaryawan.position.nama')
                    ->label('Jabatan')
                    ->default('-'),
                \Filament\Tables\Columns\TextColumn::make('jumlah_kunjungan')->label('Kunjungan'),
                \Filament\Tables\Columns\TextColumn::make('jumlah_komunikasi')->label('Komunikasi'),
                \Filament\Tables\Columns\TextColumn::make('total_tindakan')
                    ->label('Total')
                    ->getStateUsing(fn ($record) => ($record->jumlah_kunjungan ?? 0) + ($record->jumlah_komunikasi ?? 0))
                    ->sortable(query: function ($query, $direction) {
                        $query->orderByRaw(
                            '(COALESCE(jumlah_kunjungan,0) + COALESCE(jumlah_komunikasi,0)) ' . $direction
                        );
                    }),
                \Filament\Tables\Columns\TextColumn::make('total_pembayaran')
                    ->label('Total Pembayaran')
                    ->formatStateUsing(fn($state) => "Rp " . number_format($state, 0, '.', ','))
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('lihat_profil')
                    ->label('Profil')
                    ->icon('heroicon-o-user-circle')
                    ->url(fn ($record) => route('filament.admin.pages.user-profile', ['id' => sha1($record->id)]))
                    ->openUrlInNewTab()
            ]);
    }

    public function getHeaderWidgets(): array
    {
        return [
            UserMonitoringOverview::class,
        ];
    }
}