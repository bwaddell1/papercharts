<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Visit;
use Livewire\WithPagination;

class VisitTable extends Component
{
    use WithPagination;

    protected $listeners = ['dateRangeUpdated' => 'handleChangeSearchDate'];
    public $start_date, $end_date;
    public $selected_rows = [];
    public $show_rows = [];

    public function mount()
    {
    }
    
    public function render()
    {
        $visits = Visit::query();
        if($this->start_date && $this->end_date) {
            $visits = $visits->where('visit_at', '>=', $this->start_date)->where('visit_at', '<=', $this->end_date);
        }
        $visits = $visits->latest()->paginate(10);
        $this->show_rows = $visits->pluck('id')->toArray();
        return view('livewire.visit-table', [
            'visits' => $visits,
        ]);
    }

    public function handleChangeSearchDate($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function handleSelectRow($id)
    {
        if(in_array($id, $this->selected_rows)) {
            $this->selected_rows = array_diff($this->selected_rows, [$id]);
        } else {
            array_push($this->selected_rows, $id);
        }
    }

    public function handleSelectAll($value)
    {
        if($value) {
            $this->selected_rows = $this->show_rows;
        }
        else {
            $this->selected_rows = [];
        }
    }
}
