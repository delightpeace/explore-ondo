<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\PlaceImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlaceImageController extends Controller
{
    public function create(Request $request, Place $place): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('places', 'public');

        PlaceImage::create([
            'place_id' => $place->id,
            'url' => 'storage/'.$path,
            'path' => $path,
            'label' => $place->name,
        ]);

        return to_route('places')
            ->with('success', 'Place image uploaded successfully');
    }
}
