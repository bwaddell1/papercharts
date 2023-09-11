<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use App\Models\Visit;

class DeleteVisit extends Component
{
    public $visit_id;
    
    protected $listeners = ['deleteVisit' => 'setVisit',];

    public function setVisit($visit_id)
    {
        $this->visit_id = $visit_id;
    }

    public function handleDeleteVisit()
    {
        Visit::find($this->visit_id)->delete();        
        $this->dispatchBrowserEvent('page-reload');
    }

    public function render()
    {
        return view('livewire.visits.delete-visit');
    }
}
