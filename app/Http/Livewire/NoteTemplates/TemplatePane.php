<?php

namespace App\Http\Livewire\NoteTemplates;

use App\Models\NoteTemplate;
use App\Models\Specialty;
use Livewire\Component;

class TemplatePane extends Component
{

    public $mode, $template;
    public $collapseDropdown = true;
    public $specialties = [];
    public $selected_specialties = [];
    public $template_content, $template_second_column_content, $visit_type = "";
    protected $listeners = [
        'editorjs-save:template' => 'handleChangeTemplate',
        'editorjs-save:template_second_column' => 'handleChangeTemplateSecondColumn',
    ];

    private $placeholder = '{"time":1694709745372,"blocks":[{"id":"visit_type","type":"header","data":{"text":"Add Title","level":1}},{"id":"description","type":"paragraph","data":{"text":"<span style=\\"color: rgb(0, 0, 0); font-family: Inter, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;\\">Add description</span>","alignment":"left"}}],"version":"2.28.0"}';
    public $vitals = ["heart_rate", "respiratory_rate", "Height/Weight", "blood_pressure", "BMI"];
    public $selected_vitals = [];
    public $footer_elements = ["signature", "time", "date"];
    public $selected_elements = ["signature" => true];
    public $histories = ["medications", "allergies", "family_history", "social_history"];
    public $selected_histories = [];
    public $allow_third_column;

    protected $queryString = ['allow_third_column' => ['except' => false]];

    public function mount()
    {
        $this->specialties = Specialty::all();
        if ($this->mode == "create") {
            $this->template_content = json_decode($this->placeholder, true);
        }
        if ($this->mode == "edit") {
            $this->template_content = json_decode($this->template->content, true);
            $this->visit_type = $this->template->visit_type;
            $this->selected_vitals = json_decode($this->template->vitals, true);
            $this->selected_elements = json_decode($this->template->footer, true);
            $this->selected_histories = json_decode($this->template->history, true);
            $this->selected_specialties = $this->template->specialties->pluck('id')->toArray();
            $this->template_second_column_content = json_decode($this->template->second_content, true);
            if ($this->allow_third_column === null) {
                $this->allow_third_column = $this->template->third_column_enabled > 0 ? true : false;
            }
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

    public function handleChangeTemplateSecondColumn($editorJsonData)
    {
        $this->template_second_column_content = $editorJsonData;
    }

    public function set_specialty($specialty)
    {
        if (in_array($specialty, $this->selected_specialties)) {
            $this->selected_specialties = array_diff($this->selected_specialties, [$specialty]);
        } else {
            array_push($this->selected_specialties, $specialty);
        }
    }

    public function save()
    {
        $rows = $this->template_content['blocks'];
        $this->visit_type = "";
        foreach ($rows as $row) {
            if ($row['id'] == 'visit_type') {
                $this->visit_type = $row['data']['text'];
            }
        }
        if ($this->visit_type == "") {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'You should add a title!']);
            return false;
        }
        if (count($this->selected_specialties) == 0) {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'You should select at least one specialty!']);
            return false;
        }
        if ($this->mode == 'create' || (auth()->user()->currentTeam && $this->template != null && $this->template->is_public)) {
            if (auth()->user()->currentTeam && $this->template != null && $this->template->is_public && $this->visit_type == $this->template->visit_type) {
                $this->visit_type = $this->visit_type . " (Cloned by " . auth()->user()->currentTeam->name . ")";
            }
            $same_name_exist = NoteTemplate::where('visit_type', $this->visit_type)->where('team_id', auth()->user()->currentTeam->id)->exists();
            if ($same_name_exist) {
                $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Visit type already exists! Please use a different title.']);
                return false;
            }
            $this->template = NoteTemplate::create([
                'visit_type' => $this->visit_type,
                'content' => json_encode($this->template_content),
                'second_content' => json_encode($this->template_second_column_content),
                'vitals' => json_encode($this->selected_vitals),
                'footer' => json_encode($this->selected_elements),
                'history' => json_encode($this->selected_histories),
                'team_id' => auth()->user()->currentTeam ? auth()->user()->currentTeam->id : null,
                'user_id' => auth()->user()->id,
                'is_public' => auth()->user()->currentTeam ? false : true,
                'third_column_enabled' => $this->allow_third_column,
                'status' => 'published',
            ]);
            $this->updateSpecialty();
            return redirect()->to(route("wave.templates.index"));
        }
        if ($this->mode == 'edit') {
            $this->template->update([
                'visit_type' => $this->visit_type,
                'content' => json_encode($this->template_content),
                'second_content' => json_encode($this->template_second_column_content),
                'vitals' => json_encode($this->selected_vitals),
                'footer' => json_encode($this->selected_elements),
                'history' => json_encode($this->selected_histories),
                'third_column_enabled' => $this->allow_third_column,
                'status' => 'published',
            ]);
            $this->updateSpecialty();
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Note template is updated successfully!']);
        }
    }

    private function updateSpecialty()
    {
        if (count($this->selected_specialties) == 0) {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'You should select at least one specialty!']);
            return;
        }
        foreach ($this->template->specialties as $specialty) {
            if (!in_array($specialty->id, $this->selected_specialties)) {
                $this->template->specialties()->detach($specialty->id);
            }
        }
        foreach ($this->selected_specialties as $specialty) {
            if (!$this->template->specialties->contains($specialty)) {
                $this->template->specialties()->attach($specialty);
            }
        }
    }

    public function handleShowVisit()
    {
        $this->emit('showVisit', $this->template ? $this->template->id : "preview", $this->template_content, $this->allow_third_column, $this->template_second_column_content, $this->selected_vitals, $this->selected_elements, $this->selected_histories, $this->template_second_column_content, $this->allow_third_column);
    }

    public function render()
    {
        return view('livewire.note-templates.template-pane');
    }

}
