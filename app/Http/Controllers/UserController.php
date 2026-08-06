<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
            'status'   => 'required|in:active,inactive',
            'profile_photo_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $imageName = null;

        if ($request->hasFile('profile_photo_path')) {

            $image = $request->file('profile_photo_path');

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/users'), $imageName);
        }

        User::create([
            'name'               => $request->name,
            'email'              => $request->email,
            'password'           => Hash::make($request->password),
            'phone'              => $request->phone,
            'address'            => $request->address,
            'status'             => $request->status,
            'type'             => $request->role,
            'profile_photo_path' => $imageName,
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findorfail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|min:6|confirmed',
            'profile_photo_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'type'             => $request->role,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo_path')) {

            if (
                $user->profile_photo_path &&
                file_exists(public_path('uploads/users/' . $user->profile_photo_path))
            ) {
                unlink(public_path('uploads/users/' . $user->profile_photo_path));
            }

            $image = $request->file('profile_photo_path');

            $imageName = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move(public_path('uploads/users'), $imageName);

            $data['profile_photo_path'] = $imageName;
        }

        $user->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'User updated successfully.');
    }
}
