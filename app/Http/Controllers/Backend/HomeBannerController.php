<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageGallery;
use App\Models\HomeBanner;
use App\Services\ImageOptimizerService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;

class HomeBannerController extends Controller
{
    // banner index function
    public function index()
    {
        return view('backend.home_banner.insert');
    }

    // banner store function
    public function store(Request $request, ImageOptimizerService $imageService)
    {
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|max:50',
        //     'short_description' => 'required|max:100',
        //     'long_description' => 'required|max:200',
        //     'link' => 'required|max:200',
        //     'small_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        //     'medium_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        //     'large_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        //     'extra_large_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        // ]);

        // if ($validator->fails()) {
        //     session(['test' => 'session works']);
        //     Log::info('Session before redirect', [session()->all()]);
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Define destination path
        $destinationPath = public_path('uploads/home_banner/');

        // Process each image
        $smallImageName = $imageService->resizeAndOptimize($request->file('small_image'), $destinationPath);
        $mediumImageName = $imageService->resizeAndOptimize($request->file('medium_image'), $destinationPath);
        $largeImageName = $imageService->resizeAndOptimize($request->file('large_image'), $destinationPath);
        $extraLargeImageName = $imageService->resizeAndOptimize($request->file('extra_large_image'), $destinationPath);

        // Prepare image paths
        $smallImage = 'uploads/home_banner/' . $smallImageName;
        $mediumImage = 'uploads/home_banner/' . $mediumImageName;
        $largeImage = 'uploads/home_banner/' . $largeImageName;
        $extraLargeImage = 'uploads/home_banner/' . $extraLargeImageName;

        // Save to database
        $banner = new HomeBanner;
        $banner->title = $request->title;
        $banner->short_description = $request->short_description;
        $banner->long_description = $request->long_description;
        $banner->link = $request->link;
        $banner->small_image = $smallImage;
        $banner->medium_image = $mediumImage;
        $banner->large_image = $largeImage;
        $banner->extra_large_image = $extraLargeImage;
        $banner->save();

        return back()->with('success', 'Banner Successfully Saved');
    }

    // banner View function
    public function view()
    {
        $all_banner = HomeBanner::all();
        //  dd($all_banner);
        return view('backend.home_banner.view', compact('all_banner'));
    }

    // banner Edit function
    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);
        return view('backend.home_banner.edit', compact('banner'));
    }


    // banner update function
    // public function update(Request $request, $id)
    // {

    //     if ($request->image) {
    //         $request->validate([
    //             'title' => 'required|max:50',
    //             'short_description' => 'required|max:100',
    //             'long_description' => 'required|max:200',
    //             'link' => 'required|max:200',
    //             'small_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    //             'medium_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    //             'large_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    //             'extra_large_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    //         ]);
    //         $imageName = rand() . '.' . $request->image->extension();
    //         $path = 'uploads/banner/';
    //         $request->image->move($path, $imageName);
    //         $image = $path . $imageName;
    //         $banner = HomeBanner::findOrFail($id);
    //         if (file_exists(public_path($banner->image))) {
    //             unlink(public_path($banner->image));
    //         }
    //         $banner->title = $request->title;
    //         $banner->short_description = $request->short_description;
    //         $banner->long_description = $request->long_description;
    //         $banner->link = $request->link;
    //         $banner->image = $image;
    //         $banner->update();
    //         return back()->with('success', 'banner Successfully Saved');
    //     } else {
    //         $request->validate([
    //             'title' => 'required|max:50',
    //             'short_description' => 'required|max:100',
    //             'long_description' => 'required|max:200',
    //             'link' => 'required|max:200',
    //         ]);
    //         $banner = HomeBanner::findOrFail($id);
    //         $banner->title = $request->title;
    //         $banner->short_description = $request->short_description;
    //         $banner->long_description = $request->long_description;
    //         $banner->link = $request->link;
    //         $banner->update();
    //         return redirect()->route('banner.view')->with('success', 'banner Successfully updated without image');
    //     }
    // }
    public function update(Request $request, $id, ImageOptimizerService $imageService)
    {
        $banner = HomeBanner::findOrFail($id);
        $destinationPath = public_path('uploads/home_banner/');
    
        // Small Image
        if ($request->hasFile('small_image')) {
            if (file_exists(public_path($banner->small_image))) {
                unlink(public_path($banner->small_image));
            }
            $smallImageName = $imageService->resizeAndOptimize($request->file('small_image'), $destinationPath);
            $banner->small_image = 'uploads/home_banner/' . $smallImageName;
        }
    
        // Medium Image
        if ($request->hasFile('medium_image')) {
            if (file_exists(public_path($banner->medium_image))) {
                unlink(public_path($banner->medium_image));
            }
            $mediumImageName = $imageService->resizeAndOptimize($request->file('medium_image'), $destinationPath);
            $banner->medium_image = 'uploads/home_banner/' . $mediumImageName;
        }
    
        // Large Image
        if ($request->hasFile('large_image')) {
            if (file_exists(public_path($banner->large_image))) {
                unlink(public_path($banner->large_image));
            }
            $largeImageName = $imageService->resizeAndOptimize($request->file('large_image'), $destinationPath);
            $banner->large_image = 'uploads/home_banner/' . $largeImageName;
        }
    
        // Extra Large Image
        if ($request->hasFile('extra_large_image')) {
            if (file_exists(public_path($banner->extra_large_image))) {
                unlink(public_path($banner->extra_large_image));
            }
            $extraLargeImageName = $imageService->resizeAndOptimize($request->file('extra_large_image'), $destinationPath);
            $banner->extra_large_image = 'uploads/home_banner/' . $extraLargeImageName;
        }
    
        // Update text content
        $banner->title = $request->title;
        $banner->short_description = $request->short_description;
        $banner->long_description = $request->long_description;
        $banner->link = $request->link;
        $banner->save();
    
        return redirect()->route('banner.view')->with('success', 'Banner Successfully Updated');
    }


    // public function update(Request $request, $id)
    // {
    //     // Base validation rules for non-image fields
    //     $rules = [
    //         'title' => 'required|max:50',
    //         'short_description' => 'required|max:100',
    //         'long_description' => 'required|max:200',
    //         'link' => 'required|max:200',
    //     ];

    //     // Image fields (optional during update, but validated if provided)
    //     $imageFields = ['small_image', 'medium_image', 'large_image', 'extra_large_image'];
    //     foreach ($imageFields as $field) {
    //         if ($request->hasFile($field)) {
    //             $rules[$field] = 'image|mimes:jpeg,png,jpg,gif,webp|max:5120';
    //         }
    //     }

    //     // Validate the request
    //     $request->validate($rules);

    //     // Find the banner
    //     $banner = HomeBanner::findOrFail($id);
    //     $path = 'uploads/banner/';

    //     // Process each image field
    //     foreach ($imageFields as $field) {
    //         if ($request->hasFile($field)) {
    //             // Generate new image name
    //             $imageName = rand() . '.' . $request->file($field)->extension();
    //             $imagePath = $path . $imageName;

    //             // Move the new image to the destination
    //             $request->file($field)->move(public_path($path), $imageName);

    //             // Delete the old image if it exists
    //             if ($banner->$field && file_exists(public_path($banner->$field))) {
    //                 unlink(public_path($banner->$field));
    //             }

    //             // Update the banner field with the new image path
    //             $banner->$field = $imagePath;
    //         }
    //     }

    //     // Update non-image fields
    //     $banner->title = $request->title;
    //     $banner->short_description = $request->short_description;
    //     $banner->long_description = $request->long_description;
    //     $banner->link = $request->link;

    //     // Save the updated banner
    //     $banner->save();

    //     // Redirect with success message
    //     return redirect()->route('banner.view')->with('success', 'Banner Successfully Updated');
    // }
    // banner Delete function
    public function delete($id)
    {
        $banner = HomeBanner::findOrFail($id);
        if (file_exists(public_path($banner->small_image))) {
            unlink(public_path($banner->small_image));
        }

        if (file_exists(public_path($banner->medium_image))) {
            unlink(public_path($banner->medium_image));
        }

        if (file_exists(public_path($banner->large_image))) {
            unlink(public_path($banner->large_image));
        }

        if (file_exists(public_path($banner->extra_large_image))) {
            unlink(public_path($banner->extra_large_image));
        }
        $banner->delete();
        return back()->with('success', 'banner Successfully deleted');
    }
    public function bannerStatus($id)
    {
        // dd($request);
        $banner = HomeBanner::findOrFail($id);
        if ($banner->status == 0) {
            $newStatus = 1;
        } else {
            $newStatus = 0;
        }

        $banner->update([
            'status' => $newStatus
        ]);
        return redirect()->back()->with('success', 'status changed successfully');
        // return response()->json([
        //     'status' => '200',
        //     'message' => 'banner inactive successful',
        // ]);
    }

    public function viewAll()
    {
        $banners = HomeBanner::all();
        return response()->json([
            'banners' => $banners,
            'status' => '200',
            'message' => 'banner fetched successfully',
        ]);
    }

    public function show($id)
    {
        $banner = HomeBanner::findOrFail($id);
        return response()->json([
            'banner' => $banner,
            'status' => '200',
            'message' => 'banner Search successfully',
        ]);
    }
}
