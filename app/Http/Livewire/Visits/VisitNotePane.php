<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;

class VisitNotePane extends Component
{

    public $visit;
    public $collapseDropdown = true;
    public $note_content, $visit_type = "";
    protected $listeners = [
        'editorjs-save:visit_note' => 'handleChangeVisitNote',
    ];

    private $placeholder = '{"time":1694709745372,"blocks":[{"id":"description","type":"paragraph","data":{"text":"","alignment":"left"}}],"version":"2.28.0"}';

    public function mount()
    {
        $this->note_content = json_decode($this->visit->note_content ?? $this->placeholder, true);
    }

    public function hideDropDown()
    {
        $this->collapseDropdown = true;
    }

    public function handleChangeVisitNote($editorJsonData)
    {
        $this->note_content = $editorJsonData;
    }

    public function save()
    {
        $rows = $this->note_content['blocks'];
        $this->visit->update([
            'note_content' => json_encode($this->note_content),
            'second_note_content' => json_encode($this->second_column_content),
        ]);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Visit Note is updated successfully!']);
    }

    public function clearNote()
    {
        $this->visit->update([
            'note_content' => $this->placeholder,
        ]);
        $this->dispatchBrowserEvent('page-reload');
    }

    public function copyText()
    {
        $this->dispatchBrowserEvent('clipboard', ['message' => jsonToText(json_encode($this->note_content))]);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Copied!']);
    }

    public function render()
    {
        return view('livewire.visits.visit-note-pane');
    }
}
