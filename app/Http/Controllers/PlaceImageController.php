<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\PlaceImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function destroy(Place $place, PlaceImage $image): RedirectResponse
    {
        abort_unless($image->place_id === $place->id, 404);

        if ($image->path) {
            Storage::disk('public')->delete($image->path);
        }

        $image->delete();

        return to_route('places.edit', $place)->with('status', 'Photo removed successfully.');
    }
}
