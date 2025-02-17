<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\NoteTemplate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use PDF;

class VisitController extends BaseController
{
    public function createVisit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|min:2|max:191',
            'last_name' => 'required|min:2|max:191',
            'datepicker' => 'required',
            'birthdate' => 'required',
            'visit_type' => 'required',
        ]);

        $parsedDate = date_parse($validated['datepicker']);
        $parsedBirthDate = date_parse($validated['birthdate']);

        Visit::create([
            "first_name" => $validated['first_name'],
            "last_name" => $validated['last_name'],
            "visit_at" => sprintf('%04d-%02d-%02d', $parsedDate['year'], $parsedDate['month'], $parsedDate['day']),
            "birthdate" => sprintf('%04d-%02d-%02d', $parsedBirthDate['year'], $parsedBirthDate['month'], $parsedBirthDate['day']),
            "visit_type" => $validated['visit_type'],
            "team_id" => auth()->user()->currentTeam->id,
            "user_id" => auth()->user()->id,
        ]);

        NoteTemplate::find($validated['visit_type'])->update([
            "last_used" => now(),
        ]);

        return redirect(route('wave.dashboard'));
    }

    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('visits'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    public function fetch()
    {
        $images = \File::allFiles(public_path('visits'));
        $output = '<div class="row">';
        foreach ($images as $image) {
            $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="' . asset('visits/' . $image->getFilename()) . '" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="' . $image->getFilename() . '">Remove</button>
            </div>
      ';
        }
        $output .= '</div>';
        echo $output;
    }

    public function delete(Request $request)
    {
        if ($request->get('name')) {
            \File::delete(public_path('visits/' . $request->get('name')));
        }
    }


    public function print(Request $request)
    {
        $data = [
            'patient_name' => $request->patient_name,
            'date' => date('m/d/Y')
        ];

        $visits = Visit::where("id", 8)->get();

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

        return view('theme::prints.visits', [
            'visits' => $visits,
            'selected_vitals' => $this->selected_vitals,
            'selected_histories' => $this->selected_histories,
            'selected_elements' => $this->selected_elements,
        ]);
    }

    public function fill_out(Request $request, $visit_id)
    {
        $visit = Visit::find($visit_id);
        if(!$visit) {
            return redirect()->route('wave.dashboard');
        }
        return view('theme::visits.fill_out', [
            "visit" => $visit,
        ]);
    }
    public function edit(Request $request, $visit_id)
    {
        $visit = Visit::find($visit_id);
        if(!$visit) {
            return redirect()->route('wave.dashboard');
        }
        return view('theme::visits.edit', [
            "visit" => $visit,
        ]);
    }
}
