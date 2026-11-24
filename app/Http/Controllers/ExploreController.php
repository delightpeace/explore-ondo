<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Category;
use App\Models\FeaturedProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExploreController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::orderBy('sort_order')->orderBy('name')->pluck('name', 'slug')->all();
        $category = $request->query('category');
        $search = trim((string) $request->query('q', ''));
        $places = Place::query()
            ->with('images')
            ->when(is_string($category) && array_key_exists($category, $categories), function ($query) use ($category): void {
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
            'categories' => $categories,
            'selectedCategory' => is_string($category) && array_key_exists($category, $categories) ? $category : null,
            'search' => $search,
        ]);
    }

    public function show(Place $place): View
    {
        $place->load('images');

        return view('explore.show', [
            'place' => $place,
            'categoryName' => Category::where('slug', $place->category)->value('name'),
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
        $people = FeaturedProfile::where('type', 'person')->orderBy('sort_order')->orderBy('name')->get();
        $featuredBusinesses = FeaturedProfile::where('type', 'business')->orderBy('sort_order')->orderBy('name')->get();

        return view('explore.people-businesses', [
            'businesses' => $businesses,
            'people' => $people,
            'featuredBusinesses' => $featuredBusinesses,
        ]);
    }
}
