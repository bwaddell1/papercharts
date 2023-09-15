<?php

namespace App\Http\Livewire\NoteTemplates;

use Livewire\Component;
use App\Models\NoteTemplate;

class DeleteNoteTemplate extends Component
{
    public $noteTemplate_id, $noteTemplate_name;
    
    protected $listeners = ['deleteNoteTemplate' => 'setNoteTemplate',];

    public function setNoteTemplate($noteTemplate_id)
    {
        $this->noteTemplate_id = $noteTemplate_id;
    }

    public function handleDeleteNoteTemplate()
    {
        NoteTemplate::find($this->noteTemplate_id)->delete();        
        $this->dispatchBrowserEvent('page-reload');
    }

    public function render()
    {
        return view('livewire.note-templates.delete-note-template');
    }
}
