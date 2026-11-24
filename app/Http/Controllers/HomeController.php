<?php

namespace App\Http\Controllers;

use App\Models\Place;

class HomeController extends Controller
{
    public function index()
    {
        $places = Place::with('images')->get();
        $categoryIcons = [
            'attractions' => '◉',
            'schools' => '▤',
            'stays' => '⌂',
            'worship' => '⌂',
            'markets' => '⌂',
            'food' => '✦',
            'health' => '+',
            'events' => '✦',
            'motor-parks' => '↗',
            'services' => '＋',
        ];
        $categoryStyles = [
            'attractions' => 'category-culture',
            'schools' => 'category-services',
            'markets' => 'category-market',
            'food' => 'category-food',
            'stays' => 'category-stay',
        ];
        $categories = Place::query()
            ->selectRaw('category, COUNT(*) as places_count')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->filter(fn ($row) => isset(ExploreController::CATEGORIES[$row->category]))
            ->map(fn ($row) => [
                'slug' => $row->category,
                'name' => ExploreController::CATEGORIES[$row->category],
                'count' => (int) $row->places_count,
                'icon' => $categoryIcons[$row->category] ?? '◉',
                'style' => $categoryStyles[$row->category] ?? 'category-neutral',
            ])
            ->values();

        return view('home', [
            'places' => $places,
            'categories' => $categories,
        ]);
    }
}
