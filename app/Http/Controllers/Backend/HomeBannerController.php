<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageGallery;
use App\Models\HomeBanner;

class HomeBannerController extends Controller
{
    // banner index function
    public function index()
    {
        return view('backend.home_banner.insert');
    }

    // banner store function
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'short_description' => 'required|max:100',
            'long_description' => 'required|max:200',
            'link' => 'required|max:200',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->image) {
            // $imageName = rand() . '.' . $request->image->extension();
            // $request->image->move(public_path('uploads/banner/'), $imageName);
            $imageName = rand() . '.' . $request->image->extension();
            $path= 'uploads/banner/';
            $request->image->move($path,$imageName);
             $image=$path.$imageName;

            $banner = new HomeBanner;
            $banner->title = $request->title;
            $banner->short_description = $request->short_description;
            $banner->long_description = $request->long_description;
            $banner->link = $request->link;
            $banner->image =$image;
            $banner->save();
            if ($request->galleryimages) {
                $allImages = $request->galleryimages;
                foreach ($allImages as $galleryImage) {
                    $imageName = rand() . '.' . $galleryImage->extension();
                    $path= 'uploads/banner/gallery/';
                    $galleryImage->move(public_path('uploads/banner/gallery/'), $imageName);
                    $ImageGallery = new ImageGallery;
                    $ImageGallery->banner_id = $banner->id;
                    $ImageGallery->image =$path.$imageName;
                    $ImageGallery->save();
                }
            }
            return back()->with('success', 'banner Successfully Saved');
        }
    }

    // banner View function
    public function view()
    {
        $all_banner = HomeBanner::all();
        return view('backend.home_banner.view', compact('all_banner'));
    }

    // banner Edit function
    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);
        return view('backend.home_banner.edit', compact('banner'));
    }


    // banner update function
    public function update(Request $request, $id)
    {

        if ($request->image) {
            $request->validate([
                'title' => 'required|max:50',
                'short_description' => 'required|max:100',
                'long_description' => 'required|max:200',
                'link' => 'required|max:200',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);
            $imageName = rand() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/banner/'), $imageName);
            $banner = HomeBanner::findOrFail($id);
            unlink(public_path('uploads/banner/') . $banner->image);
            $banner->title = $request->title;
            $banner->short_description = $request->short_description;
            $banner->long_description = $request->long_description;
            $banner->link = $request->link;
            $banner->image = $imageName;
            $banner->update();
            if ($request->galleryimages) {
                $allImages = $request->galleryimages;
                foreach ($allImages as $galleryImage) {
                    $imageName = rand() . '.' . $galleryImage->extension();
                    $galleryImage->move(public_path('uploads/banner/gallery/'), $imageName);
                    $ImageGallery = new ImageGallery;
                    $ImageGallery->banner_id = $banner->id;
                    $ImageGallery->image = $imageName;
                    $ImageGallery->update();
                }
            }
            return back()->with('success', 'banner Successfully Saved');
        } else {
            $request->validate([
                'title' => 'required|max:50',
                'short_description' => 'required|max:100',
                'long_description' => 'required|max:200',
                'link' => 'required|max:200',
            ]);
            $banner = HomeBanner::findOrFail($id);
            $banner->title = $request->title;
            $banner->short_description = $request->short_description;
            $banner->long_description = $request->long_description;
            $banner->link = $request->link;
            $banner->update();
            return redirect()->route('banner.view')->with('success', 'banner Successfully updated without image');
        }
    }
    // banner Delete function
    public function delete($id)
    {
        $banner = HomeBanner::findOrFail($id);
        unlink(public_path('uploads/banner/') . $banner->image);
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

    public function viewAll(){
        $banners = HomeBanner::all();
        return response()->json([
            'banners' => $banners,
            'status' => '200',
            'message' => 'banner fetched successfully',
        ]);
    }

    public function show($id){
        $banner = HomeBanner::findOrFail($id);
        return response()->json([
            'banner' => $banner,
            'status' => '200',
            'message' => 'banner Search successfully',
        ]);
    }
}
