<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function edit()
    {
        $card = Card::first();
        return view('admin.cards.edit', compact('card'));
    }

    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',

            'head1' => 'required|string|max:255',
            'body1' => 'required|string',

            'head2' => 'required|string|max:255',
            'body2' => 'required|string',

            'head3' => 'required|string|max:255',
            'body3' => 'required|string',
        ]);

        $card->update($request->all());

        return redirect()->back()->with('success', 'Card updated successfully!');
    }
}