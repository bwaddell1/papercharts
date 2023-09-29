<?php

namespace App\Http\Livewire\Visits;

use App\Models\Visit;
use Illuminate\Http\Response;
use Livewire\Component;
use Livewire\WithPagination;
use App\Jobs\GenerateNoteJob;
use PDF;

class VisitTable extends Component
{
    use WithPagination;

    protected $listeners = ['dateRangeUpdated' => 'handleChangeSearchDate', 'printVisits'];
    public $start_date, $end_date;
    public $selected_rows = [], $show_rows = [];
    public $filterProvider = "";
    public $generate_note_id, $prompt = "", $note_generating = false;

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

        $visits[0]->status = "printed";
        $visits[0]->save();

        return response()->streamDownload(fn() =>
            print($pdf)
            , "Visit - #{$visits[0]->id}.pdf");
    }

    public function generate_note()
    {
        dispatch(new GenerateNoteJob($this->generate_note_id, $this->prompt));
        $visit = Visit::find($this->generate_note_id);
        $visit->note_content = null;
        $visit->save();
        $this->dispatchBrowserEvent('generateNote');
        $this->note_generating = true;
    }

    public function handleOpenQuickNoteModal($visit_id)
    {
        $this->generate_note_id = $visit_id;
    }

    public function closeQuickNoteModal()
    {
        $this->prompt = "";
        $this->generate_note_id = null;
        $this->note_generating = false;
    }

    public function check_generate_note()
    {
        if($this->generate_note_id)
        {
            $visit = Visit::find($this->generate_note_id);
            if($visit->note_content)
            {
                $this->dispatchBrowserEvent('CompleteGenerateNote', ['visit_id' => $visit->id]);
            }
        }
    }

}
