<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use App\Models\Visit;

class EditVisit extends Component
{
    public $visit_id, $visit_at, $visit_type, $first_name, $last_name;

    protected $listeners = ['editVisit' => 'setVisit', 'setVisitDate' => 'handleChangeVisitDate'];

    public function setVisit($visit_id)
    {
        $this->visit_id = $visit_id;
        $visit = Visit::find($visit_id);
        $this->visit_at = date('m/d/Y', strtotime($visit->visit_at));
        $this->visit_type = $visit->visit_type;
        $this->first_name = $visit->first_name;
        $this->last_name = $visit->last_name;
    }

    public function handleSubmit()
    {
        $validated = $this->validate([
            'first_name' => 'required|min:2|max:191',
            'last_name' => 'required|min:2|max:191',
            'visit_at' => 'required',
            'visit_type' => 'required'
        ]);

        $parsedDate = date_parse($validated['visit_at']);

        Visit::find($this->visit_id)->update([
            "first_name" => $validated['first_name'],
            "last_name" => $validated['last_name'],
            "visit_at" => sprintf('%04d-%02d-%02d', $parsedDate['year'], $parsedDate['month'], $parsedDate['day']),
            "visit_type" => $validated['visit_type'],
        ]);
        $this->dispatchBrowserEvent('closeEditVisitModal');
    }

    public function handleChangeVisitDate($date)
    {
        $this->visit_at = $date;
    }

    public function render()
    {
        return view('livewire.visits.edit-visit');
    }
}
