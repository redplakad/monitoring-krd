<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\MonitoringKredit;
use App\Models\MonitoringBuktiTindakan;
use App\Models\NominatifKredit;
use Illuminate\Support\Facades\Auth;

class MonitoringKreditCrud extends Component
{
    use WithFileUploads, WithPagination;

    public $recordId;
    public $cif;
    public $nama_nasabah;
    public $modalFormVisible = false;
    public $monitoring_id;
    public $tindakan, $pembayaran, $hasil_tindakan;
    public $photos = [];
    public $confirmingDeleteId = null;
    public $viewing = false;
    public $viewData = [];
    public $successMessage = null;
    public $deleteSuccessMessage = null;
    protected $paginationTheme = 'tailwind'; // sesuaikan dengan styling

    public function mount($recordId)
    {
        $this->recordId = $recordId;
        $nominatif = NominatifKredit::where('NOMOR_REKENING', $recordId)->first();
        if ($nominatif) {
            $this->cif = $nominatif->NO_CIF;
            $this->nama_nasabah = $nominatif->NAMA_NASABAH;
        }
    }

    public function showViewModal($id)
    {
        $this->viewData = MonitoringKredit::with('buktiTindakan', 'user')->findOrFail($id)->toArray();
        $this->viewing = true;
    }

    public function showCreateModal()
    {
        $this->resetForm();
        $this->modalFormVisible = true;
    }

    public function showEditModal($id)
    {
        $this->resetForm();
        $monitoring = MonitoringKredit::findOrFail($id);
        $this->monitoring_id = $monitoring->id;
        $this->tindakan = $monitoring->TINDAKAN;
        $this->pembayaran = $monitoring->PEMBAYARAN;
        $this->hasil_tindakan = $monitoring->HASIL_TINDAKAN;
        $this->modalFormVisible = true;
    }

    public function resetForm()
    {
        $this->monitoring_id = null;
        $this->tindakan = null;
        $this->pembayaran = null;
        $this->hasil_tindakan = null;
        $this->photos = [];
    }

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:1024',
        ]);
    }

    public function save()
    {
        $this->validate([
            'tindakan' => 'required|string|max:255',
            'pembayaran' => 'nullable|numeric',
            'hasil_tindakan' => 'required|string|max:255',
        ]);

        $monitoring = MonitoringKredit::updateOrCreate(
            ['id' => $this->monitoring_id],
            [
                'CIF' => $this->cif,
                'NAMA_NASABAH' => $this->nama_nasabah,
                'NOMOR_REKENING' => $this->recordId,
                'TINDAKAN' => $this->tindakan,
                'PEMBAYARAN' => $this->pembayaran ?? 0,
                'HASIL_TINDAKAN' => $this->hasil_tindakan,
                'user_id' => Auth::id(),
            ]
        );
        

        foreach ($this->photos as $photo) {
            $imageData = base64_encode(file_get_contents($photo->getRealPath()));
            MonitoringBuktiTindakan::create([
                'monitoring_id' => $monitoring->id,
                'user_id' => Auth::id(),
                'photo' => $imageData,
            ]);
        }

        $this->modalFormVisible = false;
        $this->resetPage();
        //$this->successMessage = 'Data penagihan berhasil disimpan.';
    }

    public function delete($id)
    {
        MonitoringKredit::find($id)->delete();
        $this->resetPage();
        $this->deleteSuccessMessage = 'Data penagihan berhasil dihapus.';
    }

    public function confirmDelete()
    {
        MonitoringKredit::find($this->confirmingDeleteId)?->delete();
        $this->confirmingDeleteId = null;
        $this->resetPage();
        $this->deleteSuccessMessage = 'Data penagihan berhasil dihapus.';
    }

    public function render()
    {
        $monitorings = MonitoringKredit::where('NOMOR_REKENING', $this->recordId)
            ->with('user', 'buktiTindakan')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('livewire.monitoring-kredit-crud', [
            'monitorings' => $monitorings,
        ]);
    }
}
