<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;

class VisitUploadPane extends Component
{

    public $visits = [];

    protected $listeners = ['fetchUploadedVisits' => 'fetchUploadedVisits'];

    public function fetchUploadedVisits()
    {
        $this->visits = \File::allFiles(public_path('visits'));
    }

    public function render()
    {
        return view('livewire.visits.visit-upload-pane');
    }
}
