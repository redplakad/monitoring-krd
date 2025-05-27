<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\MonitoringKredit;

class MonitoringTableFilter extends Component
{
    public $userId;
    public $periode = 'all';
    public $loading = false;
    public $monitoringData = [];
    
    public function mount($userId)
    {
        $this->userId = $userId;
        $this->loadData();
    }
    
    public function loadData()
    {
        $this->loading = true;
        
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
                  ->where(function($q) use ($weekNum, $startOfMonth) {
                      $q->whereRaw('FLOOR((DAY(created_at) - 1) / 7) + 1 = ?', [$weekNum]);
                  });
        }
        
        $this->monitoringData = $query->get()->toArray();
        $this->loading = false;
    }
    
    public function updatedPeriode()
    {
        $this->loadData();
    }
    
    public function showDetail($id)
    {
        // Livewire v3: gunakan payload named argument agar $event.detail.id terisi
        $this->dispatch('show-kredit-detail', id: $id);
    }
    
    public function render()
    {
        return view('livewire.monitoring-table-filter');
    }
}