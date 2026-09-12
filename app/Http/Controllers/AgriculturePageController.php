<?php

namespace App\Http\Controllers;

use App\Models\AgricultureProject;

class AgriculturePageController extends Controller
{
    public function index()
    {
        $projects = AgricultureProject::with('media')->latest()->paginate(9);

        return view('public.agriculture.index', compact('projects'));
    }

    public function show(string $slug)
    {
        $project = AgricultureProject::with('media')->where('slug', $slug)->firstOrFail();

        return view('public.agriculture.show', compact('project'));
    }
}
