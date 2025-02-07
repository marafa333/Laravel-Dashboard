<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', [

            'products' => $products,
        ]);
    }


    public function create()
    {
        return view('admin.products.create', [

        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:50',
            'description' => 'nullable|string|max:255',

            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $imageName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/products');
            $file->move($destinationPath, $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        }

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);

        return redirect()->route('products.index')
                         ->with('success', 'تم إنشاء المنتج بنجاح.');
    }


    public function show(Product $product)
    {
        return view('admin.products.show', [

            'product' => $product,
        ]);
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', [

            'product' => $product,
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'price'       => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $updateData = [
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
        ];

        if ($request->hasFile('image')) {

            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $file = $request->file('image');
            $imageName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/products');
            $file->move($destinationPath, $imageName);
            $updateData['image'] = 'uploads/products/' . $imageName;
        }

        $product->update($updateData);

        return redirect()->route('products.index')
                         ->with('edit', 'تم تحديث المنتج بنجاح.');
    }


    public function destroy(Product $product)
    {

        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('products.index')
                         ->with('delete', 'تم حذف المنتج بنجاح.');
    }
}
