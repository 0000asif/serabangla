<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    public function edit($type)
    {
        $policy = Policy::firstOrCreate(
            ['type' => $type],
            ['content' => '']
        );

        return view('admin.policies.edit', compact('policy'));
    }

    // Update policy
    public function update(Request $request, $type)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $policy = Policy::updateOrCreate(
            ['type' => $type],
            ['content' => $request->content]
        );

        return redirect()->route('admin.policies.edit', $type)->with('success', ucfirst($type) . ' updated successfully!');
    }
}