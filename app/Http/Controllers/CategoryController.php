<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // Show create form
   
    public function create()
    {
        return view('category.create');
    }

    // Show edit form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name_categorie' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:entreprise,individu',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Category::create([
            'name_categorie' => $request->name_categorie,
            'description' => $request->description,
            'type' => $request->type,
            'image' => $imageName,
        ]);

        return redirect()->route(
            $request->type === 'entreprise' 
                ? 'services.corporate.list' 
                : 'services.individual.list'
        );
    }

    // Update a category
    public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'name_categorie' => 'required|string|max:255',
        'description' => 'nullable|string',
        'type' => 'required|in:entreprise,individu',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except('image');

    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($category->image) {
            $oldImagePath = public_path('images/' . $category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        // Save the new image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $data['image'] = $imageName;
    }

    $category->update($data);

    return redirect()->route(
        $data['type'] === 'entreprise' 
            ? 'services.corporate.list' 
            : 'services.individual.list'
    );
}
    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route(
            $category->type === 'entreprise' 
                ? 'services.corporate.list' 
                : 'services.individual.list'
        );
    }
}