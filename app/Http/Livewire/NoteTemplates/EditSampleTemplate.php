<?php

namespace App\Http\Livewire\NoteTemplates;

use App\Models\Specialty;
use Livewire\Component;

class EditSampleTemplate extends Component
{

    public $mode, $template;
    public $collapseDropdown = true;
    public $template_content, $template_second_column_content, $visit_type = "";
    protected $listeners = [
        'editorjs-save:sample' => 'handleChangeTemplate',
    ];

    private $placeholder = '{"time":1694709745372,"blocks":[{"id":"description","type":"paragraph","data":{"text":"","alignment":"left"}}],"version":"2.28.0"}';

    public function mount()
    {
        $this->template_content = json_decode($this->template->sample_note ?? $this->placeholder, true);
        $this->visit_type = $this->template->visit_type;
    }

    public function hideDropDown()
    {
        $this->collapseDropdown = true;
    }

    public function handleChangeTemplate($editorJsonData)
    {
        $this->template_content = $editorJsonData;
    }

    public function save()
    {
        $this->template->update([
            'sample_note' => json_encode($this->template_content),
        ]);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Sample note template is updated successfully!']);
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
