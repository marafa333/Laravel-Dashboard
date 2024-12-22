<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // Display a listing of products
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('admin.products.create');
    }

    // Store a newly created Product in storage
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:50',
        'description' => 'nullable|string|max:255',
        'price' => 'nullable|string|max:100',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/products'), $imageName);
        $imagePath = 'uploads/products/' . $imageName;
    }

    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}


    // Display the specified product
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Show the form for editing the specified product
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update the specified product in storage
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:50',
        'description' => 'nullable|string|max:255',
        'price' => 'nullable|string|max:100',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $file = $request->file('image');
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/products'), $imageName);
        $product->image = 'uploads/products/' . $imageName;
    }

    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price'=> $request->price,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


    // Remove the specified product from storage
    public function destroy(Product $product)
    {
        if (File::exists(public_path('uploads/' . $product->image))) {
            File::delete(public_path('uploads/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}