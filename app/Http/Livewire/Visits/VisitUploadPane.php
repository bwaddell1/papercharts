<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;

class VisitUploadPane extends Component
{

    public $visits = [];

    protected $listeners = ['fetchUploadedVisits'];

    public function fetchUploadedVisits()
    {
        $this->visits = \File::allFiles(public_path('visits'));
        $this->visits = array_map(function ($visit) {
            return [
                "name" => $visit->getFilename(),
            ];
        }, $this->visits);
    }

    public function render()
    {
        return view('livewire.visits.visit-upload-pane');
    }
}
