<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use App\Jobs\OcrVisitJob;

class FillOutVisit extends Component
{
    public $visit, $selected_vitals = [], $selected_histories = [], $selected_elements = [];
    protected $listeners = ['submitImage' => 'submitImage',];

    public function mount($visit)
    {
        $this->visit = $visit;
        $this->selected_vitals = json_decode($visit->visitType->vitals, true);
        $this->selected_histories = json_decode($visit->visitType->history, true);
        $this->selected_elements = json_decode($visit->visitType->footer, true);
    }

    public function submitImage($image)
    {
        if($this->visit) {
            $filename = microtime() . '.jpg';
            \Image::make(file_get_contents($image))->save(public_path('scanning/' . $filename));
            dispatch(new OcrVisitJob(public_path('scanning/' . $filename)));
            $this->visit->status = "processing";
            $this->visit->save();
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Scanning process start!']);
            $this->emit('backToVisits');
        }
    }

    public function render()
    {
        return view('livewire.visits.fill-out-visit');
    }
}
