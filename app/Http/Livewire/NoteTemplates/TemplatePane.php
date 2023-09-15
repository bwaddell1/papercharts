<?php

namespace App\Http\Livewire\NoteTemplates;

use Livewire\Component;
use App\Models\NoteTemplate;
use App\Models\Specialty;

class TemplatePane extends Component
{

    public $mode, $template;
    public $collapseDropdown = true;
    public $specialties = [];
    public $selected_specialties = [];
    public $template_content, $visit_type = "";
    protected $listeners = [
        'editorjs-save:template' => 'handleChangeTemplate',
    ];
    
    private $placeholder = '{"time":1694709745372,"blocks":[{"id":"dCaXH7VEce","type":"header","data":{"text":"Add Title","level":1}},{"id":"rW4933SKvS","type":"paragraph","data":{"text":"<span style=\"color: rgb(0, 0, 0); font-family: Inter, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;\">Add des<\/span>c<editorjs-style><editorjs-style class=\"\" style=\"margin-bottom: 8px; display: inline-block;\">ription<\/editorjs-style><\/editorjs-style>","alignment":"left"}},{"id":"j0NcmPUZY1","type":"paragraph","data":{"text":"<editorjs-style class=\"template-subject bg-gray-50 font-semibold pl-8 text-gray-500\">Subjective<\/editorjs-style><editorjs-style class=\"template-content bg-gray-50 font-semibold\" style=\"\">add sample hpi text here.. as if it were a completed note<\/editorjs-style>","alignment":"left"}},{"id":"rNEFvpPM-W","type":"paragraph","data":{"text":"<editorjs-style class=\"template-subject template-white-content font-semibold pl-8 text-gray-500\">Objective<\/editorjs-style><editorjs-style class=\"template-content template-white-content font-semibold\" style=\"\">(select vital signs on the right column to include in your note)<\/editorjs-style>","alignment":"left"}},{"id":"j0NcmPUZY2","type":"paragraph","data":{"text":"<editorjs-style class=\"template-subject bg-gray-50 font-semibold pl-8 text-gray-500\">Physical Exam<\/editorjs-style><editorjs-style class=\"template-content bg-gray-50 font-semibold\" style=\"\">Add a physical Exam to suit your needs<\/editorjs-style>","alignment":"left"}},{"id":"rNEFvpPM-a","type":"paragraph","data":{"text":"<editorjs-style class=\"template-subject template-white-content font-semibold pl-8 text-gray-500\">Assessment<\/editorjs-style><editorjs-style class=\"template-content template-white-content font-semibold\" style=\"\">Add a diagnosis and ICD10 code<\/editorjs-style>","alignment":"left"}},{"id":"j0NcmPUZY3","type":"paragraph","data":{"text":"<editorjs-style class=\"template-subject bg-gray-50 font-semibold pl-8 text-gray-500\">Plan<\/editorjs-style><editorjs-style class=\"template-content bg-gray-50 font-semibold\" style=\"\">Add a plan<\/editorjs-style>","alignment":"left"}}],"version":"2.28.0"}';
    public $vitals = ["heart_rate", "respiratory_rate", "weight", "blood_pressure", "BMI"];
    public $selected_vitals = [];
    public $footer_elements = ["signature", "time", "date"];
    public $selected_element;
    
    public function mount()
    {
        $this->specialties = Specialty::all();
        if($this->mode == "create") {
            $this->template_content = json_decode($this->placeholder, true);
        }
        if($this->mode == "edit") {
            $this->template_content = json_decode($this->template->content, true);
            $this->visit_type = $this->template->visit_type;
            $this->selected_vitals = json_decode($this->template->vitals, true);
            $this->selected_element = $this->template->footer;
            $this->selected_specialties = $this->template->specialties->pluck('id')->toArray();
        }
    }

    public function hideDropDown()
    {
        $this->collapseDropdown = true;
    }

    public function handleChangeTemplate($editorJsonData)
    {
        $this->template_content = $editorJsonData;
    }

    public function set_specialty($specialty)
    {
        if(in_array($specialty, $this->selected_specialties)) {
            $this->selected_specialties = array_diff($this->selected_specialties, [$specialty]);
        } else {
            array_push($this->selected_specialties, $specialty);
        }
    }

    public function save()
    {
        if(count($this->selected_specialties) == 0) {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'You should select at least one specialty!']);
            return false;
        }
        if($this->mode == 'create') {
            $this->template = NoteTemplate::create([
                'visit_type' => $this->visit_type,
                'content' => json_encode($this->template_content),
                'vitals' => json_encode($this->selected_vitals),
                'footer' => $this->selected_element,
                'status' => 'published',
            ]);
        }
        $this->updateSpecialty();
        if($this->mode == 'edit') {
            $this->template->update([
                'visit_type' => $this->visit_type,
                'content' => json_encode($this->template_content),
                'vitals' => json_encode($this->selected_vitals),
                'footer' => $this->selected_element,
                'status' => 'published',
            ]);
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Note template is updated successfully!']);
            return;
        }
        return redirect()->to(route("wave.templates.index"));
    }

    private function updateSpecialty()
    {
        if(count($this->selected_specialties) == 0) {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'You should select at least one specialty!']);
            return;
        }
        foreach($this->template->specialties as $specialty) {
            if(!in_array($specialty->id, $this->selected_specialties)) {
                $this->template->specialties()->detach($specialty->id);
            }
        }
        foreach($this->selected_specialties as $specialty) {
            if(!$this->template->specialties->contains($specialty)) {
                $this->template->specialties()->attach($specialty);
            }
        }
    }

    public function render()
    {
        return view('livewire.note-templates.template-pane');
    }

}
