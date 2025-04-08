<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ImageOptimizerService;
use Exception;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.brands.insert');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ImageOptimizerService $imageService)
    {
        $request->validate([
            'BrandName' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->image) {
            $destinationPath = public_path('uploads/brands/');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $image = 'uploads/brands/' . $imageName;
            $Brand = new Brand;
            $Brand->BrandName = $request->BrandName;
            $Brand->slug = Str::slug($request->BrandName);
            $Brand->image = $image;
            $Brand->save();
            return back()->with('success', 'Brand Successfully Added');
        }
    }

    /**
     * Display the Brands Table.
     */
    public function show()
    {
        $Brands = Brand::all();
        // @dd($Brands->all());
        return view('backend.brands.view', compact('Brands'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, ImageOptimizerService $imageService)
    {

        if ($request->image) {
            $request->validate([
                'BrandName' => 'required|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $destinationPath = public_path('uploads/brands/');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $image = 'uploads/brands/' . $imageName;
            $brand = Brand::findOrFail($id);

            if (file_exists($brand->image)) {
            unlink($brand->image);
            }
            $brand->BrandName = $request->BrandName;
            $brand->slug = Str::slug($request->BrandName);
            $brand->image = $image;
            $brand->update();
            return redirect()->route('brand.view')->with('success', 'Brand Successfully updated');
        } else {
            $request->validate([
                'BrandName' => 'required|max:100',
            ]);
            $brand = Brand::findOrFail($id);
            $brand->BrandName = $request->BrandName;
            $brand->slug = Str::slug($request->BrandName);
            $brand->update();
            return redirect()->route('brand.view')->with('success', 'Brand Successfully updated without image');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Brands = Brand::findOrFail($id);
        $Brands->delete();
        return back()->with('success', 'Brands Successfully deleted');
    }

    //Rest Api Start

}
