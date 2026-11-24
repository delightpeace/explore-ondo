<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $places = Place::with('images')->get();
        $categories = Category::withCount('places')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('home', [
            'places' => $places,
            'categories' => $categories,
        ]);
    }
}
