<?php

namespace App\Http\Livewire\Visits;

use App\Jobs\GenerateNoteJob;
use App\Models\Visit;
use File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class VisitTable extends Component
{
    use WithPagination;

    protected $listeners = ['dateRangeUpdated' => 'handleChangeSearchDate', 'printVisits', 'reloadVisits'];
    public $start_date, $end_date;
    public $selected_rows = [], $show_rows = [], $pdf_list = [];
    public $filterProvider = "";
    public $generate_note_id, $prompt = "", $note_generating = false, $showPreviewModal = false;

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

        $this->selected_vitals = array_filter(json_decode($template->vitals, true), function ($e) {
            return $e;
        });

        $this->selected_histories = array_filter(json_decode($template->history, true), function ($e) {
            return $e;
        });

        $this->selected_elements = array_filter(json_decode($template->footer, true), function ($e) {
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

    public function showPrintVisits()
    {
        if (count($this->selected_rows) == 0) {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Please select visits to print!']);
            return;
        }
        $this->showPreviewModal = true;
        $visits = Visit::whereIn('id', $this->selected_rows)->get();

        $this->pdf_list = [];
        File::cleanDirectory("storage/print_pdfs");

        foreach ($visits as $visit) {
            $template = $visit->visitType;

            $this->selected_vitals = array_filter(json_decode($template->vitals, true), function ($e) {
                return $e;
            });

            $this->selected_histories = array_filter(json_decode($template->history, true), function ($e) {
                return $e;
            });

            $this->selected_elements = array_filter(json_decode($template->footer, true), function ($e) {
                return $e;
            });

            $pdf = PDF::loadView('theme::prints.visits', [
                'visits' => [$visit],
                'selected_vitals' => $this->selected_vitals,
                'selected_histories' => $this->selected_histories,
                'selected_elements' => $this->selected_elements,
            ])->output();

            $visit->status = "printed";
            $visit->save();

            Storage::put("public/print_pdfs/{$visit->id}.pdf", $pdf);
            array_push($this->pdf_list, [
                "name" => "$visit->first_name $visit->last_name",
                "link" => "storage/print_pdfs/{$visits[0]->id}.pdf",
                "visitType" => $visit->visitType->visit_type,
                "id" => $visit->id,
            ]);
        }
    }

    public function closePrintVisits()
    {
        $this->showPreviewModal = false;
        $this->pdf_list = [];
    }

    public function downloadZipFiles()
    {
        $zip = new \ZipArchive();
        $fileName = "Visits-" . now()->format('YmdHis') . ".zip";
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE) == true) {
            $files = File::files(public_path('storage/print_pdfs'));
            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();

        }

        File::cleanDirectory("storage/print_pdfs");
        // return Storage::disk('exports')->download("Visits-" . now()->format('YmdHis') . ".zip");
        return response()->download(public_path($fileName));
    }

    public function reloadVisits()
    {

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
        if ($this->generate_note_id) {
            $visit = Visit::find($this->generate_note_id);
            if ($visit->note_content) {
                $this->dispatchBrowserEvent('CompleteGenerateNote', ['visit_id' => $visit->id]);
            }
        }
    }

}
