<?php

namespace App\Http\Livewire\NoteTemplates;

use Livewire\Component;
use App\Models\NoteTemplate;
use App\Models\Visit;

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
        Visit::where("visit_type", $this->noteTemplate_id)->delete();
        NoteTemplate::find($this->noteTemplate_id)->delete();
        $this->dispatchBrowserEvent('page-reload');
    }

    public function render()
    {
        return view('livewire.note-templates.delete-note-template');
    }
}
