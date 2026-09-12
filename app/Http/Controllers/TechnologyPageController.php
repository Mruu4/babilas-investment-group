<?php

namespace App\Http\Controllers;

use App\Models\TechnologyProject;

class TechnologyPageController extends Controller
{
    public function index()
    {
        $projects = TechnologyProject::with('media')->latest()->paginate(9);

        return view('public.technology.index', compact('projects'));
    }

    public function show(string $slug)
    {
        $project = TechnologyProject::with('media')->where('slug', $slug)->firstOrFail();

        return view('public.technology.show', compact('project'));
    }
}
