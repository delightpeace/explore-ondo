<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PlaceImageController extends Controller
{
    public function create(Request $request, Place $place): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('places', 'public');

        $place->update([
            'image' => $path,
        ]);

        return to_route('places')
            ->with('success', 'Place image uploaded successfully');
    }
}
