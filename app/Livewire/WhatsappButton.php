<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NominatifKredit;

class WhatsappButton extends Component
{
    public $recordId;
    public $nomorRekening;
    public $nominalTunggakan = 0;
    public $formattedPhone;
    public $waLink;
    public $record = [];
    public $kolekText;
    public $datadate;
    
    public function mount($nomorRekening)
    {
        $this->nomorRekening = $nomorRekening;
        // Ambil datadate terakhir dari NominatifKredit
        $this->datadate = NominatifKredit::orderByDesc('DATADATE')->value('DATADATE');
        $this->loadData();
    }
    
    public function loadData()
    {
        // Tambahkan filter datadate
        $record = NominatifKredit::where('NOMOR_REKENING', $this->nomorRekening)
            ->where('DATADATE', $this->datadate)
            ->first();
        
        if ($record) {
            $this->record = $record->toArray();
            
            // Format kolektibilitas 
            $kolekMap = [
                1 => '1 - Lancar',
                2 => '2 - Dalam perhatian khusus',
                3 => '3 - Kurang Lancar',
                4 => '4 - Diragukan',
                5 => '5 - Macet',
            ];
            
            $this->kolekText = $kolekMap[$this->record['KODE_KOLEK'] ?? 0] ?? '-';
            
            // Hitung total tunggakan
            $this->nominalTunggakan = ($this->record['TUNGGAKAN_POKOK'] ?? 0) + ($this->record['TUNGGAKAN_BUNGA'] ?? 0);
            
            // Format nomor telepon untuk WhatsApp
            $this->formattedPhone = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $this->record['NO_HP']));
            
            // Generate WhatsApp link
            $this->generateWhatsAppLink();
        }
    }
    
    public function generateWhatsAppLink()
    {
        if (empty($this->record)) return;
        
        $waMessage = 
            "Assalamu'alaikum Wr.Wb.\n" .
            "kami dari bagian penagihan PT BPR SERANG (Perseroda) Cabang Kragilan\n" .
            "memberitahukan kepada bapak/ibu/sdr(i) tentang kewajiban angsuran anda:\n\n" .
            "Nama : {$this->record['NAMA_NASABAH']}\n" .
            "Alamat : {$this->record['ALAMAT']}\n" .
            "Tempat Bekerja : {$this->record['TEMPAT_BEKERJA']}\n" .
            "No Rekening : {$this->record['NOMOR_REKENING']}\n" .
            'Plafon pinjaman : Rp. ' . number_format($this->record['PLAFOND_AWAL'], 0, ',', '.') . "\n" .
            'Baki debet : Rp. ' . number_format($this->record['POKOK_PINJAMAN'], 0, ',', '.') . "\n" .
            'Angsuran : Rp. ' . number_format($this->record['ANGSURAN_TOTAL'], 0, ',', '.') . "\n" .
            'Tunggakan Pokok : Rp. ' . number_format($this->record['TUNGGAKAN_POKOK'], 0, ',', '.') . "\n" .
            'Tunggakan Bunga : Rp. ' . number_format($this->record['TUNGGAKAN_BUNGA'], 0, ',', '.') . "\n" .
            'TOTAL TAGIHAN : Rp. ' . number_format($this->nominalTunggakan, 0, ',', '.') . "\n" .
            "Kolektibilitas : {$this->kolekText}\n\n" .
            "Agar segera melakukan pembayaran sesuai dengan tagihan tsb\n" .
            "terimakasih\n\n" .
            'Jika sudah membayar tagihan mohon lampirkan bukti bayar anda, terimakasih.';
            
        $waText = urlencode($waMessage);
        $this->waLink = "https://wa.me/{$this->formattedPhone}?text={$waText}";
    }
    
    public function render()
    {
        return view('livewire.whatsapp-button');
    }
}
