<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    // Display a listing of categories
    public function index()
    {
        $categories = DB::select('select * from categories');
        return view('admin.categories.index', [
            'user' => auth()->user(),
            'categories' => $categories,
        ]);
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('admin.categories.create', [
            'user' => auth()->user(),
        ]);
    }

    // Store a newly created category in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $imageName);
            $imagePath = 'uploads/categories/' . $imageName;
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }


    // Display the specified category
    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'user' => auth()->user(),
            'category' => $category,
        ]);
    }

    // Show the form for editing the specified category
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'user' => auth()->user(),
            'category' => $category,
        ]);
    }

    // Update the specified category in storage
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $imageName);
            $category->image = 'uploads/categories/' . $imageName;
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('edit', 'Category updated successfully.');
    }


    // Remove the specified category from storage
    public function destroy(Category $category)
    {
        if (File::exists(public_path('uploads/' . $category->image))) {
            File::delete(public_path('uploads/' . $category->image));
        }

        $category->delete();

        return redirect()->route('categories.index')->with('delete', 'Category deleted successfully.');
    }
}
