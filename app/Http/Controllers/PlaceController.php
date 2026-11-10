<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\PlaceImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /** @var list<string> */
    private const CATEGORIES = ['attractions', 'schools', 'stays', 'worship', 'markets', 'food', 'health', 'events', 'services'];

    public function index()
    {
        $places = Place::with('images')->get();

        return view('places', [
            'places' => $places,
        ]);
    }

    public function addPlace(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|in:'.implode(',', self::CATEGORIES),
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $place = Place::create($validatedData);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('places', 'public');
            PlaceImage::create([
                'place_id' => $place->id,
                'url' => 'storage/'.$path,
                'path' => $path,
                'label' => $place->name,
            ]);
        }

        return to_route('places')->with('status', 'Place added successfully.');
    }

    public function update(Request $request, Place $place): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|in:'.implode(',', self::CATEGORIES),
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('places', 'public');
            PlaceImage::create([
                'place_id' => $place->id,
                'url' => 'storage/'.$path,
                'path' => $path,
                'label' => $place->name,
            ]);
        }

        unset($validatedData['image']);
        $place->update($validatedData);

        return to_route('places')->with('status', 'Place updated successfully.');
    }

    public function delete($id)
    {
        $place = Place::findOrFail($id);

        $place->delete();

        return to_route('places')->with('status', 'Place deleted successfully.');
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);

        return view('detail', [
            'place' => $place,
        ]);
    }
}
