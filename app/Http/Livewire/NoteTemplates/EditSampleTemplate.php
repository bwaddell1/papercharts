<?php

namespace App\Http\Livewire\NoteTemplates;

use App\Models\Specialty;
use Livewire\Component;

class EditSampleTemplate extends Component
{

    public $mode, $template;
    public $collapseDropdown = true;
    public $specialties = [];
    public $selected_specialties = [];
    public $template_content, $visit_type = "";
    protected $listeners = [
        'editorjs-save:sample' => 'handleChangeTemplate',
    ];

    public $vitals = ["heart_rate", "respiratory_rate", "Height/Weight", "blood_pressure", "BMI"];
    public $selected_vitals = [];
    public $footer_elements = ["signature", "time", "date"];
    public $selected_elements = ["signature" => true];
    public $histories = ["medications", "allergies", "family_history", "social_history"];
    public $selected_histories = [];

    public function mount()
    {
        $this->specialties = Specialty::all();
        $this->template_content = json_decode($this->template->sample_note ?? $this->template->content, true);
        $this->visit_type = $this->template->visit_type;
        $this->selected_vitals = json_decode($this->template->vitals, true);
        $this->selected_elements = json_decode($this->template->footer, true);
        $this->selected_histories = json_decode($this->template->history, true);
        $this->selected_specialties = $this->template->specialties->pluck('id')->toArray();
    }

    public function hideDropDown()
    {
        $this->collapseDropdown = true;
    }

    public function handleChangeTemplate($editorJsonData)
    {
        $this->template_content = $editorJsonData;
    }

    public function set_specialty($specialty)
    {
        if (in_array($specialty, $this->selected_specialties)) {
            $this->selected_specialties = array_diff($this->selected_specialties, [$specialty]);
        } else {
            array_push($this->selected_specialties, $specialty);
        }
    }

    public function save()
    {
        $this->template->update([
            'sample_note' => json_encode($this->template_content),
        ]);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Sample note template is updated successfully!']);
    }

    private function updateSpecialty()
    {
        if (count($this->selected_specialties) == 0) {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'You should select at least one specialty!']);
            return;
        }
        foreach ($this->template->specialties as $specialty) {
            if (!in_array($specialty->id, $this->selected_specialties)) {
                $this->template->specialties()->detach($specialty->id);
            }
        }
        foreach ($this->selected_specialties as $specialty) {
            if (!$this->template->specialties->contains($specialty)) {
                $this->template->specialties()->attach($specialty);
            }
        }
    }

    public function handleShowVisit()
    {
        $this->emit('showVisit', $this->template_content, $this->selected_vitals, $this->selected_elements, $this->selected_histories);
    }

    public function render()
    {
        return view('livewire.note-templates.edit-sample-template');
    }
}
