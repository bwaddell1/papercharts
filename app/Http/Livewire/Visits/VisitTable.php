<?php

namespace App\Http\Livewire\Visits;

use App\Models\Visit;
use Illuminate\Http\Response;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class VisitTable extends Component
{
    use WithPagination;

    protected $listeners = ['dateRangeUpdated' => 'handleChangeSearchDate', 'printVisits'];
    public $start_date, $end_date;
    public $selected_rows = [], $show_rows = [];
    public $filterProvider = "";
    public $show_visit_id = true, $show_last_name = true, $show_first_name = true, $show_visit_at = true, $show_visit_type = true, $show_ready = true, $show_status = true;

    public function mount()
    {
    }

    public function render()
    {
        $visits = Visit::query();
        if (auth()->user()->currentTeam) {
            $visits = $visits->where('team_id', auth()->user()->currentTeam->id);
        }
        if ($this->filterProvider) {
            $visits = $visits->where('user_id', $this->filterProvider);
        }
        if ($this->start_date && $this->end_date) {
            $visits = $visits->where('visit_at', '>=', $this->start_date)->where('visit_at', '<=', $this->end_date);
        }
        $visits = $visits->latest()->paginate(10);
        $this->show_rows = $visits->pluck('id')->toArray();
        return view('livewire.visits.visit-table', [
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
        if (in_array($id, $this->selected_rows)) {
            $this->selected_rows = array_diff($this->selected_rows, [$id]);
        } else {
            array_push($this->selected_rows, $id);
        }
    }

    public function handleSelectAll($value)
    {
        if ($value) {
            $this->selected_rows = $this->show_rows;
        } else {
            $this->selected_rows = [];
        }
    }

    public function printVisits($visit_id)
    {

        $visits = Visit::where('id', $visit_id)->get();

        $template = $visits[0]->visitType;

        $this->selected_vitals = array_filter(json_decode($template->vitals, true), function($e) {
            return $e;
        });
        
        $this->selected_histories = array_filter(json_decode($template->history, true), function($e) {
            return $e;
        });

        $this->selected_elements = array_filter(json_decode($template->footer, true), function($e) {
            return $e;
        });

        $pdf = PDF::loadView('theme::prints.visits', [
            'visits' => $visits,
            'selected_vitals' => $this->selected_vitals,
            'selected_histories' => $this->selected_histories,
            'selected_elements' => $this->selected_elements,
        ])->output();

        return response()->streamDownload(fn() =>
            print($pdf)
            , "Visit - #{$visits[0]->id}.pdf");
    }

}
