<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\MonitoringKredit;

class MonitoringTableFilter extends Component
{
    use WithPagination;
    public $userId;
    public $periode = 'all';
    public $loading = false;
    public $search = '';
    public $tindakan = '';
    public $perPage = 25;
    public $tindakanList = [];

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->tindakanList = MonitoringKredit::where('user_id', $userId)
            ->select('TINDAKAN')->distinct()->pluck('TINDAKAN')->filter()->values()->toArray();
        $this->loadData();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingTindakan()
    {
        $this->resetPage();
    }
    public function updatingPeriode()
    {
        $this->resetPage();
    }

    public function loadData()
    {
        $this->loading = true;
        $this->loading = false;
    }

    public function getMonitoringDataProperty()
    {
        $query = MonitoringKredit::where('user_id', $this->userId)->with('buktiTindakan');
        if ($this->periode === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        } elseif (str_starts_with($this->periode, 'week')) {
            $weekNum = (int) str_replace('week', '', $this->periode);
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $query->where('created_at', '>=', $startOfMonth)
                  ->where('created_at', '<=', $endOfMonth)
                  ->whereRaw('FLOOR((DAY(created_at) - 1) / 7) + 1 = ?', [$weekNum]);
        }
        if ($this->search) {
            $query->where('NAMA_NASABAH', 'like', '%'.$this->search.'%');
        }
        if ($this->tindakan) {
            $query->where('TINDAKAN', $this->tindakan);
        }
        return $query->orderByDesc('created_at')->paginate($this->perPage);
    }

    public function showDetail($id)
    {
        $this->dispatch('show-kredit-detail', id: $id);
    }
    public function render()
    {
        return view('livewire.monitoring-table-filter', [
            'monitoringData' => $this->monitoringData,
        ]);
    }
}