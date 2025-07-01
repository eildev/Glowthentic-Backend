<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Features;
use App\Services\ImageOptimizerService;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeatureController extends Controller
{
    public function index()
    {
        return view('backend.features.insert');
    }

    public function store(Request $request, ImageOptimizerService $imageService)
    {
        $request->validate([
            'feature_name' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->image) {
            $destinationPath = public_path('uploads/feature/');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $image = 'uploads/feature/' . $imageName;
            $feature = new Features;
            $feature->feature_name = $request->feature_name;
            // $feature->slug = Str::slug($request->feature_name);
            $feature->slug = SlugService::generateUniqueSlug($request->feature_name, Features::class);
            $feature->image = $image;
            $feature->save();
            return back()->with('success', 'Feature Successfully Added');
        }
    }

    public function view()
    {
        $features = Features::all();
        return view('backend.features.view', compact('features'));
    }

    public function edit($id)
    {
        $feature = Features::findOrFail($id);
        return view('backend.features.edit', compact('feature'));
    }

    public function update(Request $request, $id, ImageOptimizerService $imageService)
    {
        $request->validate([
            'feature_name' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->image) {
            $destinationPath = public_path('uploads/feature/');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $image = 'uploads/feature/' . $imageName;
            $feature = Features::findOrFail($id);
            $oldImagePath = public_path($feature->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $feature->feature_name = $request->feature_name;
            $feature->slug = Str::slug($request->feature_name);
            $feature->image = $image;
            $feature->update();
            return redirect()->route('feature.view')->with('success', 'Feature Successfully updated');
        } else {
            $feature = Features::findOrFail($id);
            $feature->feature_name = $request->feature_name;
            $feature->slug = Str::slug($request->feature_name);
            $feature->update();
            return redirect()->route('feature.view')->with('success', 'Feature Successfully updated without image');
        }
    }

    public function delete($id)
    {
        $feature = Features::findOrFail($id);
        $oldImagePath = public_path($feature->image);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        $feature->delete();
        return back()->with('success', 'Feature Successfully deleted');
    }

    public function statusUpdate($id)
    {
        $feature = Features::findOrFail($id);
        if ($feature->status === 0) {
            $newStatus = 1;
        } else {
            $newStatus = 0;
        }

        $feature->update([
            'status' => $newStatus
        ]);
        return redirect()->back()->with('message', 'status changed successfully');
    }
}