<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NoteTemplate;

class TemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme::template.index');
    }

    public function create()
    {
        return view('theme::template.create');
    }
    
    public function edit(Request $request, $template_id)
    {
        return view('theme::template.edit', [
            "template" => NoteTemplate::find($template_id),
        ]);
    }
}
