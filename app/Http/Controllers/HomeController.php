<?php

namespace App\Http\Controllers;

use App\Models\place;


class HomeController extends Controller
{
    public function index()
    {
        $places = place::all();
        return view('home', [
            'places' => $places
        ]);
    }
}
