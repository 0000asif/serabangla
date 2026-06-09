<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HeroController extends Controller
{
     public function edit()
    {
        $hero = Hero::first();
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $request->validate([
            'badge'    => 'required|string|max:255',
            'title'    => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['badge', 'title', 'subtitle']);

        // IMAGE UPLOAD (public/heroes)
        if ($request->hasFile('image')) {

            // delete old image
            if ($hero->image && file_exists(public_path('heroes/'.$hero->image))) {
                unlink(public_path('heroes/'.$hero->image));
            }

            $imageName = time().'-hero.'.$request->image->extension();
            $request->image->move(public_path('heroes'), $imageName);
            $data['image'] = $imageName;
        }

        $hero->update($data);

        return redirect()->back()->with('success', 'Hero section updated successfully!');
    }
}