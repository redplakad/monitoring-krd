<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\MonitoringKredit;
use App\Models\MonitoringBuktiTindakan;
use App\Models\NominatifKredit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public $oldPhotos = [];
    public $photoToDelete = null;
    public $confirmingDeleteId = null;
    public $viewing = false;
    public $viewData = [];
    public $successMessage = null;
    public $deleteSuccessMessage = null;
    public $editSuccessMessage = null;
    protected $paginationTheme = 'tailwind'; // sesuaikan dengan styling
    public $latitude;
    public $longitude;

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
        $this->reset(['tindakan', 'pembayaran', 'hasil_tindakan', 'photos', 'oldPhotos', 'monitoring_id', 'latitude', 'longitude']);
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
        $this->oldPhotos = MonitoringBuktiTindakan::where('monitoring_id', $monitoring->id)->get();
        // Ambil koordinat terakhir jika ada
        $koordinat = \App\Models\MonitoringKoordinat::where('user_id', Auth::id())
            ->where('nomor_rekening', $this->recordId)
            ->latest()->first();
        $this->latitude = $koordinat ? $koordinat->latitude : null;
        $this->longitude = $koordinat ? $koordinat->longitude : null;
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
    public function confirmDeletePhoto($photoId)
    {
        $this->photoToDelete = $photoId;
        $this->dispatch('show-delete-photo-confirmation');
    }
    public function deletePhoto()
    {
        if ($this->photoToDelete) {
            $photo = MonitoringBuktiTindakan::find($this->photoToDelete);
            if ($photo) {
                // Hapus file fisik dari storage
                if ($photo->photo && Storage::disk('public')->exists($photo->photo)) {
                    Storage::disk('public')->delete($photo->photo);
                }
                $photo->delete();
            }
            // Refresh foto lama
            $this->oldPhotos = MonitoringBuktiTindakan::where('monitoring_id', $this->monitoring_id)->get();
            $this->photoToDelete = null;
        }
    }

    public function save()
    {
        $this->validate([
            'tindakan' => 'required|string|max:255',
            'pembayaran' => 'nullable|numeric',
            'hasil_tindakan' => 'required|string|max:255',
            'photos.*' => 'image|max:1024',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $isUpdate = !is_null($this->monitoring_id);

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

        // Simpan koordinat jika ada
        if ($this->latitude && $this->longitude) {
            \App\Models\MonitoringKoordinat::create([
                'user_id' => Auth::id(),
                'nomor_rekening' => $this->recordId,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]);
        }

        // Simpan file gambar ke storage dan path ke database
        foreach ($this->photos as $photo) {
            $path = $photo->store('bukti_tindakan', 'public');
            MonitoringBuktiTindakan::create([
                'monitoring_id' => $monitoring->id,
                'user_id' => Auth::id(),
                'photo' => $path, // hanya path, bukan base64
            ]);
        }

        $this->modalFormVisible = false;
        $this->resetPage();

        if ($isUpdate) {
            $this->editSuccessMessage = 'Data berhasil diubah!';
        } else {
            $this->successMessage = 'Data penagihan berhasil disimpan.';
        }
    }

    public function delete($id)
    {
        $monitoring = MonitoringKredit::find($id);
        if ($monitoring) {
            // Hapus semua bukti tindakan terkait (file & database)
            $buktis = MonitoringBuktiTindakan::where('monitoring_id', $monitoring->id)->get();
            foreach ($buktis as $bukti) {
                if ($bukti->photo && \Storage::disk('public')->exists($bukti->photo)) {
                    \Storage::disk('public')->delete($bukti->photo);
                }
                $bukti->delete();
            }
            $monitoring->delete();
        }
        $this->resetPage();
        $this->deleteSuccessMessage = 'Data penagihan berhasil dihapus.';
    }

    public function confirmDelete()
    {
        $monitoring = MonitoringKredit::find($this->confirmingDeleteId);
        if ($monitoring) {
            // Hapus semua bukti tindakan terkait (file & database)
            $buktis = MonitoringBuktiTindakan::where('monitoring_id', $monitoring->id)->get();
            foreach ($buktis as $bukti) {
                if ($bukti->photo && \Storage::disk('public')->exists($bukti->photo)) {
                    \Storage::disk('public')->delete($bukti->photo);
                }
                $bukti->delete();
            }
            $monitoring->delete();
        }
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
