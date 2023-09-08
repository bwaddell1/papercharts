<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Visit;
use Livewire\WithPagination;

class VisitTable extends Component
{
    use WithPagination;

    public $start_date, $end_date;

    public function mount()
    {
    }
    
    public function render()
    {
        $visits = Visit::latest()->paginate(10);
        return view('livewire.visit-table', [
            'visits' => $visits,
        ]);
    }
}
