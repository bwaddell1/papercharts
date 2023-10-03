<?php

namespace App\Http\Livewire\NoteTemplates;

use Livewire\Component;
use App\Models\NoteTemplate;
use App\Models\Specialty;

class SampleTemplateTable extends Component
{
    public $search_key = "";
    public $specialties = [];
    public $filter_specialties = [];

    public function mount()
    {
        $this->specialties = Specialty::all();
    }

    public function search($search_key)
    {
        $this->search_key = $search_key;
    }

    public function set_filter_specialty($specialty)
    {
        if (in_array($specialty, $this->filter_specialties)) {
            $this->filter_specialties = array_diff($this->filter_specialties, [$specialty]);
        } else {
            array_push($this->filter_specialties, $specialty);
        }
    }

    public function render()
    {
        $templates = NoteTemplate::query();
        if ($this->search_key != "") {
            $templates = $templates->where('visit_type', 'like', '%' . $this->search_key . '%');
        }
        foreach ($this->filter_specialties as $specialty) {
            $templates = $templates->whereHas('specialties', function ($q) use ($specialty) {
                $q->where('specialty_id', $specialty);
            });
        }
        if (auth()->user()->currentTeam) {
            $templates = $templates->where(function ($query) {
                $query->where('team_id', auth()->user()->currentTeam->id)->orWhere('is_public', true);
            });
        }
        $templates = $templates->latest()->paginate(10);
        return view('livewire.note-templates.sample-template-table', [
            'templates' => $templates,
        ]);
    }

}
