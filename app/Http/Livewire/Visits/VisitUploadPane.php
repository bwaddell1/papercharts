<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use App\Jobs\OcrVisitJob;
use App\Models\Visit;
use Libern\QRCodeReader\QRCodeReader;

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

    public function onClickCancel($name)
    {
        unlink(public_path('visits/' . $name));
        $this->visits = \File::allFiles(public_path('visits'));
        $this->visits = array_map(function ($visit) {
            return [
                "name" => $visit->getFilename(),
            ];
        }, $this->visits);
    }

    public function handleScanFiles()
    {
        if(count($this->visits) == 0)
        {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'There is no uploaded files to scan!']);
            return;
        }
        foreach($this->visits as $visit)
        {
            if(\Illuminate\Support\Str::endsWith($visit['name'], '.pdf')) {
                \File::move(public_path('visits/' . $visit['name']), public_path('scanning/' . $visit['name']));
                $pdf = new \Spatie\PdfToImage\Pdf(public_path('scanning/' . $visit['name']));
                $pdf->saveImage(public_path('scanning/' . $visit['name'] . '.jpg'));
                dispatch(new OcrVisitJob(public_path('scanning/' . $visit['name'] . '.jpg')));
                $QRCodeReader = new QRCodeReader();
                $qrcode_text = $QRCodeReader->decode(public_path('scanning/' . $visit['name'] . '.jpg'));
                $qrcode_info = json_decode($qrcode_text, true);
                $visit_id = $qrcode_info['visit_id'];
                $visit = Visit::find($visit_id);
                $visit->status = "processing";
                $visit->save();
            }
            else {
                \File::move(public_path('visits/' . $visit['name']), public_path('scanning/' . $visit['name']));
                dispatch(new OcrVisitJob(public_path('scanning/' . $visit['name'])));
                $QRCodeReader = new QRCodeReader();
                $qrcode_text = $QRCodeReader->decode(public_path('scanning/' . $visit['name']));
                $qrcode_info = json_decode($qrcode_text, true);
                $visit_id = $qrcode_info['visit_id'];
                $visit = Visit::find($visit_id);
                $visit->status = "processing";
                $visit->save();
            }
        }
        $this->emit('reloadVisits');
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Scanning process start!']);
        $this->visits = [];
        $this->dispatchBrowserEvent('close_upload_modal');
    }

    public function render()
    {
        return view('livewire.visits.visit-upload-pane');
    }
}
