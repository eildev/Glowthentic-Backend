<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Features;
use App\Services\ImageOptimizerService;
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
            $Brand = new Features;
            $Brand->feature_name = $request->feature_name;
            $Brand->slug = Str::slug($request->feature_name);
            $Brand->image = $image;
            $Brand->save();
            return back()->with('success', 'Feature Successfully Added');
        }
    }

    public function view()
    {
        $Brands = Features::all();
        return view('backend.features.view', compact('Brands'));
    }

    public function edit($id)
    {
        $brand = Features::findOrFail($id);
        return view('backend.features.edit', compact('brand'));
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
            $brand = Features::findOrFail($id);
            $oldImagePath = public_path($brand->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $brand->feature_name = $request->feature_name;
            $brand->slug = Str::slug($request->feature_name);
            $brand->image = $image;
            $brand->update();
            return redirect()->route('feature.view')->with('success', 'Feature Successfully updated');
        } else {
            $brand = Features::findOrFail($id);
            $brand->feature_name = $request->feature_name;
            $brand->slug = Str::slug($request->feature_name);
            $brand->update();
            return redirect()->route('feature.view')->with('success', 'Feature Successfully updated without image');
        }
    }

    public function delete($id)
    {
        $Brands = Features::findOrFail($id);
        $oldImagePath = public_path($Brands->image);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        $Brands->delete();
        return back()->with('success', 'Feature Successfully deleted');
    }
}