<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KreditNotes;
use App\Models\NominatifKredit;
use Illuminate\Support\Facades\Auth;

class KreditNotesCrud extends Component
{
    public $nomorRekening;
    public $showModal = false;
    public $notes = [];
    
    public $noteId = null;
    public $content = '';
    public $tag = 'note';
    
    public $successMessage = null;
    
    protected $rules = [
        'content' => 'required|string|min:3',
        'tag' => 'required|string'
    ];

    public function mount($nomorRekening)
    {
        $this->nomorRekening = $nomorRekening;
        $this->loadNotes();
    }
    
    public function loadNotes()
    {
        $this->notes = KreditNotes::where('nomor_rekening', $this->nomorRekening)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->get();
    }
    
    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
    
    // Added a named "set" method to update the showModal property directly
    public function setShowModal($value)
    {
        if ($value) {
            $this->resetForm();
        }
        $this->showModal = $value;
    }
    
    public function resetForm()
    {
        $this->noteId = null;
        $this->content = '';
        $this->tag = '';
        $this->resetValidation();
    }
    
    public function save()
    {
        $this->validate();
        
        KreditNotes::updateOrCreate(
            ['id' => $this->noteId],
            [
                'nomor_rekening' => $this->nomorRekening,
                'user_id' => Auth::id(),
                'tag' => $this->tag,
                'content' => $this->content,
            ]
        );
        
        $this->successMessage = $this->noteId ? 'Catatan berhasil diperbarui.' : 'Catatan berhasil ditambahkan.';
        $this->loadNotes();
        $this->closeModal();
    }
    
    public function editNote($id)
    {
        $note = KreditNotes::findOrFail($id);
        $this->noteId = $note->id;
        $this->content = $note->content;
        $this->tag = $note->tag;
        
        $this->showModal = true;
    }
    
    public function deleteNote($id)
    {
        KreditNotes::findOrFail($id)->delete();
        $this->successMessage = 'Catatan berhasil dihapus.';
        $this->loadNotes();
    }
    
    public function resetSuccessMessage()
    {
        $this->successMessage = null;
    }
    
    public function render()
    {
        return view('livewire.kredit-notes-crud');
    }
}
