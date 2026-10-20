<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();

        return view('places', [
            'places' => $places
        ]);
    }

    public function addPlace(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
        ]);

        Place::create($validatedData);

        return redirect('/places');
    }

    public function update(Request $request, Place $place): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('places', 'public');
        }

        Place::create($validatedData);

        return redirect('/places');
    }

    public function delete($id)
    {
        $place = Place::findOrFail($id);

        $place->delete();

        return redirect('/places');
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);

        return view('detail', [
            'place' => $place
        ]);
    }
}
