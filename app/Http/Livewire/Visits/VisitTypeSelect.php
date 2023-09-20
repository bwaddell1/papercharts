<?php

namespace App\Http\Livewire\Visits;

use App\Models\NoteTemplate;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class VisitTypeSelect extends LivewireSelect
{

    public function options($searchTerm = ''): Collection
    {
        return NoteTemplate::where('visit_type', 'like', '%' . $searchTerm . '%')->select('id', 'visit_type')
            ->get()
            ->map(function (NoteTemplate $template) {
                return [
                    'value' => $template->id,
                    'description' => "test",
                ];
            });
    }

}
