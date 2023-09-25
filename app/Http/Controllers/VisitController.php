<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\NoteTemplate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class VisitController extends BaseController
{
    public function createVisit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|min:2|max:191',
            'last_name' => 'required|min:2|max:191',
            'datepicker' => 'required',
            'visit_type' => 'required',
        ]);

        $parsedDate = date_parse($validated['datepicker']);

        Visit::create([
            "first_name" => $validated['first_name'],
            "last_name" => $validated['last_name'],
            "visit_at" => sprintf('%04d-%02d-%02d', $parsedDate['year'], $parsedDate['month'], $parsedDate['day']),
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
}
