<?php

namespace App\Http\Controllers;

use App\Models\Place;

class HomeController extends Controller
{
    public function index()
    {
        $places = Place::with('images')->get();

        return view('home', [
            'places' => $places,
        ]);
    }
}
