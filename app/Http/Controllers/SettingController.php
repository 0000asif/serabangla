<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
      public function edit()
    {
        $setting = Setting::first(); // Only 1 row expected
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $request->validate([
            'site_title' => 'required|string|max:255',
            'logo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon'    => 'nullable|image|mimes:jpg,jpeg,png,webp,ico|max:1024',
        ]);

        $data = $request->except(['logo', 'favicon']);

        // Upload Logo
        if ($request->hasFile('logo')) {

            if ($setting->logo && file_exists(public_path('settings/' . $setting->logo))) {
                unlink(public_path('settings/' . $setting->logo));
            }

            $logoName = time() . '-logo.' . $request->logo->extension();
            $request->logo->move(public_path('settings'), $logoName);

            $data['logo'] = $logoName;
        }

        // Upload Favicon
        if ($request->hasFile('favicon')) {

            if ($setting->favicon && file_exists(public_path('settings/' . $setting->favicon))) {
                unlink(public_path('settings/' . $setting->favicon));
            }

            $faviconName = time() . '-favicon.' . $request->favicon->extension();
            $request->favicon->move(public_path('settings'), $faviconName);

            $data['favicon'] = $faviconName;
        }

        $setting->update($data);

        return back()->with('success', 'Settings updated successfully!');
    }
}
