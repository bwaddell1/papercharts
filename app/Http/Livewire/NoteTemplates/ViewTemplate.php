<?php

namespace App\Http\Livewire\NoteTemplates;

use Livewire\Component;
use App\Models\Visit;
use App\Models\NoteTemplate;
use Illuminate\Support\Facades\Storage;
use File;
use PDF;

class ViewTemplate extends Component
{

    protected $listeners = ['showVisit' => 'showComp'];

    public $template_id, $view_template, $second_column_content, $third_column_enabled, $isShow = false, $editorId, $selected_vitals = [], $selected_elements = [], $selected_histories = [];

    public function hideComp()
    {
        $this->isShow = false;
        $this->editorId = null;
    }

    public function showComp($template_id, $template, $allow_third_column, $template_second_column_content, $selected_vitals, $selected_elements, $selected_histories, $second_column_content, $third_column_enabled)
    {
        $this->editorId = microtime(true);
        $this->template_id = $template_id;
        $this->view_template = $template;
        $this->selected_vitals = array_filter($selected_vitals, function($e) {
            return $e;
        });
        $this->selected_histories = array_filter($selected_histories, function($e) {
            return $e;
        });
        $this->selected_elements = array_filter($selected_elements, function($e) {
            return $e;
        });;
        $this->isShow = true;
        $this->second_column_content = $second_column_content;
        $this->third_column_enabled = $third_column_enabled;
        File::cleanDirectory("storage/print_pdfs");
        // $visitType = NoteTemplate::where('id', $template_id)->first();
        $rows = $template['blocks'];
        $visit_type = "";
        foreach ($rows as $row) {
            if ($row['id'] == 'visit_type') {
                $visit_type = $row['data']['text'];
            }
        }
        $visitType = new NoteTemplate([
            "id" => "template id",
            "visitType" => $visit_type,
            "content" => json_encode($template),
            "second_content" => json_encode($template_second_column_content),
            "third_column_enabled" => $allow_third_column,
            'selected_vitals' => $selected_vitals,
            'selected_histories' => $selected_histories,
            'selected_elements' => $selected_elements,
        ]);

        $pdf = PDF::loadView('theme::prints.visits', [
            'visits' => [new Visit([
                "id" => "template id",
                "first_name" => "First Name",
                "last_name" => "Last Name",
                "birthdate" => now(),
                "visit_at" => now(),
                "visitType" => $visitType,
            ])],
            'selected_vitals' => $selected_vitals,
            'selected_histories' => $selected_histories,
            'selected_elements' => $selected_elements,
        ])->output();

        Storage::put("public/print_pdfs/{$template_id}.pdf", $pdf);

        $this->dispatchBrowserEvent('scroll-to-top');
    }

    public function render()
    {
        return view('livewire.note-templates.view-template');
    }
}
