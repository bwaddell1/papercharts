<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;

class VisitNotePane extends Component
{

    public $visit;
    public $collapseDropdown = true;
    public $selected_specialties = [];
    public $note_content, $second_column_content, $visit_type = "";
    protected $listeners = [
        'editorjs-save:visit_note' => 'handleChangeVisitNote',
        'editorjs-save:visit_note_second_column' => 'handleChangeVisitSecondNote',
    ];

    public $vitals = ["heart_rate", "respiratory_rate", "Height/Weight", "blood_pressure", "BMI"];
    public $selected_vitals = [];
    public $footer_elements = ["signature", "time", "date"];
    public $selected_elements = ["signature" => true];
    public $histories = ["medications", "allergies", "family_history", "social_history"];
    public $selected_histories = [];
    public $allow_third_column;

    public function mount()
    {
        $this->note_content = json_decode($this->visit->note_content ?? $this->visit->visitType->content, true);
        $this->second_column_content = json_decode($this->visit->second_note_content ?? $this->visit->visitType->second_content, true);
        $this->selected_vitals = json_decode($this->visit->visitType->vitals, true);
        $this->selected_elements = json_decode($this->visit->visitType->footer, true);
        $this->selected_histories = json_decode($this->visit->visitType->history, true);
        $this->allow_third_column = $this->visit->visitType->third_column_enabled > 0 ? true : false;
    }

    public function hideDropDown()
    {
        $this->collapseDropdown = true;
    }

    public function handleChangeVisitNote($editorJsonData)
    {
        $this->note_content = $editorJsonData;
    }

    public function handleChangeVisitSecondNote($editorJsonData)
    {
        $this->second_column_content = $editorJsonData;
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
            'note_content' => $this->visit->visitType->content,
        ]);
        $this->dispatchBrowserEvent('page-reload');
    }

    public function render()
    {
        return view('livewire.visits.visit-note-pane');
    }
}
