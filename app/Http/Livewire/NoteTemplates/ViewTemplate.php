<?php

namespace App\Http\Livewire\NoteTemplates;

use Livewire\Component;

class ViewTemplate extends Component
{

    protected $listeners = ['showVisit' => 'showComp'];

    public $view_template, $second_column_content, $third_column_enabled, $isShow = false, $editorId, $selected_vitals = [], $selected_elements = [], $selected_histories = [];

    public function hideComp()
    {
        $this->isShow = false;
        $this->editorId = null;
    }

    public function showComp($template, $selected_vitals, $selected_elements, $selected_histories, $second_column_content, $third_column_enabled)
    {
        $this->editorId = microtime(true);
        $this->view_template = $template;
        $this->selected_vitals = array_filter($selected_vitals, function($e) {
            return $e;
        });
        $this->selected_histories = array_filter($selected_histories, function($e) {
            return $e;
        });
        $this->selected_elements = array_filter($selected_elements, function($e) {
            return $e;
        });;
        $this->isShow = true;
        $this->second_column_content = $second_column_content;
        $this->third_column_enabled = $third_column_enabled;
        $this->dispatchBrowserEvent('scroll-to-top');
    }

    public function render()
    {
        return view('livewire.note-templates.view-template');
    }
}
