<?php

namespace App\Http\Controllers;

use App\Models\Property;

class RealEstatePageController extends Controller
{
    public function index()
    {
        $properties = Property::with('images')->latest()->paginate(9);

        return view('public.real-estate.index', compact('properties'));
    }

    public function show(string $slug)
    {
        $property = Property::with('images')->where('slug', $slug)->firstOrFail();

        return view('public.real-estate.show', compact('property'));
    }
}
