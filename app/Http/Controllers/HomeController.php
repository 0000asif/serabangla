<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Hero;
use App\Models\Order;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::latest()->first(); // get the latest hero record
        $cards = Card::latest()->first();
        $reviews = Review::latest()->get();
        $settings = Setting::latest()->first();
        return view('home.index', compact('hero', 'cards', 'reviews', 'settings'));
    }


    public function order(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'product' => 'required'
        ]);

        // You can store in DB / send email
        // Example:
        // Order::create($request->all());

        return back()->with('success', 'আপনার অর্ডার গ্রহণ করা হয়েছে! আমাদের প্রতিনিধি শিগগিরই যোগাযোগ করবে।');
    }
}