<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeaturedProfileController extends Controller
{
    public function index()
    {
        return view('admin.featured-profiles', [
            'profiles' => FeaturedProfile::orderBy('type')->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        FeaturedProfile::create($this->validatedProfile($request));

        return to_route('admin.featured-profiles')->with('status', 'Profile added to the public page.');
    }

    public function update(Request $request, FeaturedProfile $profile): RedirectResponse
    {
        $profile->update($this->validatedProfile($request));

        return to_route('admin.featured-profiles')->with('status', 'Profile updated.');
    }

    public function destroy(FeaturedProfile $profile): RedirectResponse
    {
        $profile->delete();

        return to_route('admin.featured-profiles')->with('status', 'Profile removed from the public page.');
    }

    private function validatedProfile(Request $request): array
    {
        return $request->validate([
            'type' => 'required|in:person,business',
            'name' => 'required|string|max:160',
            'subtitle' => 'nullable|string|max:180',
            'description' => 'required|string|max:2000',
            'image_url' => 'nullable|url|max:2048',
            'website_url' => 'nullable|url|max:2048',
            'sort_order' => 'required|integer|min:0|max:65535',
        ]);
    }
}
