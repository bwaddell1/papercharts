<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends BaseController
{
    public function createVisit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|min:2|max:191',
            'last_name' => 'required|min:2|max:191',
            'datepicker' => 'required',
            'visit_type' => 'required'
        ]);

        $parsedDate = date_parse($validated['datepicker']);

        Visit::create([
            "first_name" => $validated['first_name'],
            "last_name" => $validated['last_name'],
            "visit_at" => sprintf('%04d-%02d-%02d', $parsedDate['year'], $parsedDate['month'], $parsedDate['day']),
            "visit_type" => $validated['visit_type'],
        ]);

        return redirect(route('wave.dashboard'));
    }
}
