<?php

namespace App\Http\Livewire\Modals;

use App\Models\NoteTemplate;
use Livewire\Component;

class AddVisit extends Component
{

    public $query;
    public $templates;
    public $highlightIndex;

    public function mount()
    {
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->query = '';
        $this->templates = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->templates) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->templates) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectContact()
    {
        $contact = $this->templates[$this->highlightIndex] ?? null;
        if ($contact) {
            $this->redirect(route('show-contact', $contact['id']));
        }
    }

    public function updated($name, $value)
    {
        if ($name == 'query') {
            $this->templates = NoteTemplate::where('visit_type', 'like', '%' . $value . '%');
            if (auth()->user()->currentTeam) {
                $this->templates = $this->templates->where(function ($query) {
                    $query->where('team_id', auth()->user()->currentTeam->id)->orWhere('is_public', true);
                });
            }
            $this->templates->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.modals.add-visit');
    }
}
