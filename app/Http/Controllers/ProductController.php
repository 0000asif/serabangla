<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show product list
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    // Form page
    public function create()
    {
        return view('admin.product.create');
    }

    // Store (public path)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'images.*' => 'image|max:2048'
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->images as $file) {
                $imageName = time() . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('products'), $imageName);
                $images[] = 'products/' . $imageName;
            }
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'category' => $request->category,
            'badge' => $request->badge,
            'rating' => $request->rating,
            'status' => $request->status,
            'images' => $images,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product added successfully!');
    }

    // Edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $images = $product->images;

        if ($request->hasFile('images')) {
            foreach ($request->images as $file) {
                $imageName = time() . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('products'), $imageName);
                $images[] = 'products/' . $imageName;
            }
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'category' => $request->category,
            'badge' => $request->badge,
            'rating' => $request->rating,
            'status' => $request->status,
            'images' => $images,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
    }
    public function deleteImage($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $image = $request->image;

        $images = $product->images;

        // remove from array
        $newImages = array_filter($images, function ($img) use ($image) {
            return $img != $image;
        });

        // delete file physically
        if (file_exists(public_path($image))) {
            unlink(public_path($image));
        }

        $product->update([
            'images' => array_values($newImages)
        ]);

        return back()->with('success', 'Image removed successfully!');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // 1. Check if product is used in any order
        if ($product->orders()->exists()) {
            return back()->with('failed', 'Product cannot be deleted because it has orders.');
        }

        // 2. Delete images
        if (!empty($product->images)) {
            foreach ($product->images as $image) {
                $imagePath = public_path($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        // 3. Delete product
        $product->delete();

        return back()->with('success', 'Product deleted successfully!');
    }


    public function productsJson()
    {
        $products = Product::where('status','active')->latest()->get();

        $products = $products->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'description' => $p->description,
                'price' => $p->price,
                'oldPrice' => $p->old_price,
                'images' => $p->images ?? [], // <-- Just use it directly
                'category' => $p->category,
                'badge' => $p->badge,
                'rating' => $p->rating,
            ];
        });

        return response()->json($products);
    }
}
