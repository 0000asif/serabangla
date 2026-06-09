<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    // Show List
    public function index()
    {
        $reviews = Review::latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    // Create Page
    public function create()
    {
        return view('admin.reviews.create');
    }

    // Store Review
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'city'   => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'image'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'desc'   => 'required|string',
        ]);

        $data = $request->except('image');

        // Upload Image
        if ($request->hasFile('image')) {
            $imgName = time().'-review.'.$request->image->extension();
            $request->image->move(public_path('reviews'), $imgName);
            $data['image'] = $imgName;
        }

        Review::create($data);

        return redirect()->route('reviews.index')->with('success', 'Review added successfully!');
    }

    // Edit Page
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.reviews.edit', compact('review'));
    }

    // Update Review
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'city'   => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'desc'   => 'required|string',
        ]);

        $data = $request->except('image');

        // Replace image
        if ($request->hasFile('image')) {

            if ($review->image && file_exists(public_path('reviews/'.$review->image))) {
                unlink(public_path('reviews/'.$review->image));
            }

            $imgName = time().'-review.'.$request->image->extension();
            $request->image->move(public_path('reviews'), $imgName);
            $data['image'] = $imgName;
        }

        $review->update($data);

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully!');
    }

    // Delete Review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->image && file_exists(public_path('reviews/'.$review->image))) {
            unlink(public_path('reviews/'.$review->image));
        }

        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully!');
    }
}
