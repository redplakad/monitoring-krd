<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\MonitoringKredit;
use Carbon\Carbon;

class UserMonitoringOverview extends BaseWidget
{
    protected ?string $heading = 'Rekap penagihan';
    protected ?string $description = 'Total rekap penagihan dan monitoring kredit';
    
    protected function getMonthlyData($query, $column = '*', $type = 'count')
    {
        $data = [];
        $year = now()->year;
        $currentMonth = now()->month;

        for ($month = 1; $month <= $currentMonth; $month++) {
            $q = (clone $query)->whereYear('created_at', $year)->whereMonth('created_at', $month);
            $data[] = $type === 'sum' ? (float) $q->sum($column) : (int) $q->count();
        }
        return $data;
    }

    protected function getStats(): array
    {
        // --- Jumlah User ---
        $userNow = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $userLast = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $userGrowth = $userLast > 0 ? (($userNow - $userLast) / $userLast) * 100 : 0;
        $userGrowthText = $userGrowth > 0
            ? 'Naik ' . number_format($userGrowth, 2) . '%'
            : ($userGrowth < 0
                ? 'Turun ' . number_format(abs($userGrowth), 2) . '%'
                : 'Tetap');
        $userGrowthIcon = $userGrowth > 0
            ? 'heroicon-m-arrow-trending-up'
            : ($userGrowth < 0
                ? 'heroicon-m-arrow-trending-down'
                : 'heroicon-m-minus');

        // --- Jumlah Total Kunjungan User ---
        $kunjunganNow = MonitoringKredit::where('tindakan', 'kunjungan')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $kunjunganLast = MonitoringKredit::where('tindakan', 'kunjungan')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $kunjunganGrowth = $kunjunganLast > 0 ? (($kunjunganNow - $kunjunganLast) / $kunjunganLast) * 100 : 0;
        $kunjunganGrowthText = $kunjunganGrowth > 0
            ? 'Naik ' . number_format($kunjunganGrowth, 2) . '%'
            : ($kunjunganGrowth < 0
                ? 'Turun ' . number_format(abs($kunjunganGrowth), 2) . '%'
                : 'Tetap');
        $kunjunganGrowthIcon = $kunjunganGrowth > 0
            ? 'heroicon-m-arrow-trending-up'
            : ($kunjunganGrowth < 0
                ? 'heroicon-m-arrow-trending-down'
                : 'heroicon-m-minus');

        // --- Jumlah Total Komunikasi User ---
        $komunikasiNow = MonitoringKredit::whereIn('tindakan', ['Telepon', 'Whatsapp'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $komunikasiLast = MonitoringKredit::whereIn('tindakan', ['Telepon', 'Whatsapp'])
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $komunikasiGrowth = $komunikasiLast > 0 ? (($komunikasiNow - $komunikasiLast) / $komunikasiLast) * 100 : 0;
        $komunikasiGrowthText = $komunikasiGrowth > 0
            ? 'Naik ' . number_format($komunikasiGrowth, 2) . '%'
            : ($komunikasiGrowth < 0
                ? 'Turun ' . number_format(abs($komunikasiGrowth), 2) . '%'
                : 'Tetap');
        $komunikasiGrowthIcon = $komunikasiGrowth > 0
            ? 'heroicon-m-arrow-trending-up'
            : ($komunikasiGrowth < 0
                ? 'heroicon-m-arrow-trending-down'
                : 'heroicon-m-minus');

        // --- Jumlah Total Pembayaran ---
        $pembayaranNow = MonitoringKredit::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('pembayaran');
        $pembayaranLast = MonitoringKredit::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('pembayaran');
        $pembayaranGrowth = $pembayaranLast > 0 ? (($pembayaranNow - $pembayaranLast) / $pembayaranLast) * 100 : 0;
        $pembayaranGrowthText = $pembayaranGrowth > 0
            ? 'Naik ' . number_format($pembayaranGrowth, 2) . '%'
            : ($pembayaranGrowth < 0
                ? 'Turun ' . number_format(abs($pembayaranGrowth), 2) . '%'
                : 'Tetap');
        $pembayaranGrowthIcon = $pembayaranGrowth > 0
            ? 'heroicon-m-arrow-trending-up'
            : ($pembayaranGrowth < 0
                ? 'heroicon-m-arrow-trending-down'
                : 'heroicon-m-minus');

        // Chart data
        $userChart = $this->getMonthlyData(User::query());
        $kunjunganChart = $this->getMonthlyData(MonitoringKredit::where('tindakan', 'kunjungan'));
        $komunikasiChart = $this->getMonthlyData(MonitoringKredit::whereIn('tindakan', ['Telepon', 'Whatsapp']));
        $pembayaranChart = $this->getMonthlyData(MonitoringKredit::query(), 'pembayaran', 'sum');

        return [
            Stat::make('Pegawai', User::count())
                ->description($userGrowthText)
                ->descriptionIcon($userGrowthIcon)
                ->color('success')
                ->chart($userChart),

            Stat::make('Kunjungan', MonitoringKredit::where('tindakan', 'kunjungan')->count())
                ->description($kunjunganGrowthText)
                ->descriptionIcon($kunjunganGrowthIcon)
                ->color('success')
                ->chart($kunjunganChart),

            Stat::make('Komunikasi', MonitoringKredit::whereIn('tindakan', ['Telepon', 'Whatsapp'])->count())
                ->description($komunikasiGrowthText)
                ->descriptionIcon($komunikasiGrowthIcon)
                ->color('success')
                ->chart($komunikasiChart),

            Stat::make('Pembayaran', number_format(MonitoringKredit::sum('pembayaran'), 0, ',', '.'))
                ->description($pembayaranGrowthText)
                ->descriptionIcon($pembayaranGrowthIcon)
                ->color('success')
                ->chart($pembayaranChart),
        ];
    }
}
