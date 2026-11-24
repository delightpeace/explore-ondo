<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories', [
            'categories' => Category::withCount('places')->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create($this->validatedCategory($request));

        return to_route('admin.categories')->with('status', 'Category added.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $this->validatedCategory($request, $category);
        $oldSlug = $category->slug;

        $category->update($data);

        if ($oldSlug !== $category->slug) {
            Place::where('category', $oldSlug)->update(['category' => $category->slug]);
        }

        return to_route('admin.categories')->with('status', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->places()->exists()) {
            return to_route('admin.categories')->with('status', 'This category is assigned to places. Reassign or delete those places before removing it.');
        }

        $category->delete();

        return to_route('admin.categories')->with('status', 'Category removed.');
    }

    private function validatedCategory(Request $request, ?Category $category = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:120',
            'slug' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('categories', 'slug')->ignore($category?->id),
            ],
            'description' => 'nullable|string|max:255',
            'symbol' => 'required|string|max:12',
            'image_url' => 'nullable|url|max:2048',
            'sort_order' => 'required|integer|min:0|max:65535',
        ]);
    }
}
