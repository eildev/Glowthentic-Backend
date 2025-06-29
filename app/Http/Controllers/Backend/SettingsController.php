<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::latest()->first();
        return view('backend.settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'flexRadioDefault' => 'required|in:single,multiple',
            ]);

            // Determine the value for isMultipleCategory
            $isMultipleCategory = $request->flexRadioDefault === 'multiple' ? 1 : 0;

            // Check if a setting record exists
            $setting = Setting::latest()->first();

            if ($setting) {
                // Update existing record
                $setting->isMultipleCategory = $isMultipleCategory;
                $setting->save();
            } else {
                // Create new record
                $setting = new Setting();
                $setting->isMultipleCategory = $isMultipleCategory;
                $setting->save();
            }

            return redirect()->route('settings')->with('success', 'Settings updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('settings')->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }
}
