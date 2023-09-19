<?php

namespace App\Http\Livewire\NoteTemplates;

use Livewire\Component;

class ViewTemplate extends Component
{

    protected $listeners = ['showVisit' => 'showComp'];

    public $view_template, $isShow = false, $editorId, $selected_vitals = [], $selected_elements = [];

    public function hideComp()
    {
        $this->isShow = false;
        $this->editorId = null;
    }

    public function showComp($template, $selected_vitals, $selected_elements)
    {
        $this->editorId = microtime(true);
        $this->view_template = $template;
        $this->selected_vitals = $selected_vitals;
        $this->selected_elements = $selected_elements;
        $this->isShow = true;
    }

    public function render()
    {
        return view('livewire.note-templates.view-template');
    }
}
