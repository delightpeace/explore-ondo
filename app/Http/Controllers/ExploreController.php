<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExploreController extends Controller
{
    /** @var array<string, string> */
    private const CATEGORIES = [
        'attractions' => 'Attractions & heritage',
        'schools' => 'Schools & education',
        'stays' => 'Hotels, stays & resorts',
        'worship' => 'Churches & places of worship',
        'markets' => 'Markets & shopping',
        'food' => 'Food & restaurants',
        'health' => 'Healthcare',
        'events' => 'Events & festivals',
        'motor-parks' => 'Motor parks & transport',
        'services' => 'Useful services',
    ];

    public function index(Request $request): View
    {
        $category = $request->query('category');
        $search = trim((string) $request->query('q', ''));
        $places = Place::query()
            ->with('images')
            ->when(is_string($category) && array_key_exists($category, self::CATEGORIES), function ($query) use ($category): void {
                $query->where('category', $category);
            })
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($placeQuery) use ($search): void {
                    $placeQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('explore.index', [
            'places' => $places,
            'categories' => self::CATEGORIES,
            'selectedCategory' => is_string($category) && array_key_exists($category, self::CATEGORIES) ? $category : null,
            'search' => $search,
        ]);
    }

    public function show(Place $place): View
    {
        $place->load('images');

        return view('explore.show', [
            'place' => $place,
            'categoryName' => self::CATEGORIES[$place->category] ?? null,
        ]);
    }

    public function aboutOndo(): View
    {
        return view('explore.about-ondo');
    }

    public function peopleAndBusinesses(): View
    {
        $businesses = Place::query()
            ->with('images')
            ->whereIn('category', ['food', 'stays', 'markets', 'services', 'health'])
            ->orderBy('name')
            ->get();

        return view('explore.people-businesses', [
            'businesses' => $businesses,
        ]);
    }
}
