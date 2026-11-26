<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use App\Models\FeaturedProfile;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'placeCount' => Place::count(),
            'categoryCount' => Category::count(),
            'profileCount' => FeaturedProfile::count(),
            'subscriberCount' => DB::table('newsletter_subscribers')->count(),
        ]);
    }
}
