<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferBanner;

class OfferBannerController extends Controller
{
    // banner index function
    public function index()
    {
        return view('backend.OfferBanner.insert');
    }

    // banner store function
    public function store(Request $request)
    {
        // @dd($request->all());
        $request->validate([
            'heading' => 'required|max:50',
            'title' => 'required|max:100',
            'short_description' => 'required|max:100',
            'link' => 'required|max:200',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->image) {
            $imageName = rand() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/offer_banner/'), $imageName);
            $banner = new OfferBanner;
            $banner->title = $request->title;
            $banner->head = $request->heading;
            $banner->short_description = $request->short_description;
            $banner->link = $request->link;
            $banner->image = $imageName;
            $banner->save();
            return back()->with('success', 'banner Successfully Saved');
        }

    }

    // banner View function
    public function view()
    {
        $all_banner = OfferBanner::all();
        return view('backend.OfferBanner.view', compact('all_banner'));
    }

    // banner Edit function
    public function edit($id)
    {
        $bannerContent = OfferBanner::findOrFail($id);
        return view('backend.OfferBanner.edit', compact('bannerContent'));
    }


    // banner update function
    public function update(Request $request, $id)
    {

        if ($request->image) {
            $request->validate([
                'heading' => 'required|max:50',
                'title' => 'required|max:50',
                'short_description' => 'required|max:100',
                'link' => 'required|max:200',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);
            $imageName = rand() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/offer_banner/'), $imageName);
            $banner = OfferBanner::findOrFail($id);
            unlink(public_path('uploads/offer_banner/').$banner->image);
            $banner->title = $request->heading;
            $banner->title = $request->title;
            $banner->short_description = $request->short_description;
            $banner->link = $request->link;
            $banner->image = $imageName;
            $banner->update();
            return back()->with('success', 'banner Successfully Saved');
        }
        else {
            $request->validate([
                'heading' => 'required|max:50',
                'title' => 'required|max:50',
                'short_description' => 'required|max:100',
                'link' => 'required|max:200',
            ]);
            $banner = OfferBanner::findOrFail($id);
            $banner->title = $request->heading;
            $banner->title = $request->title;
            $banner->short_description = $request->short_description;
            $banner->link = $request->link;
            $banner->update();
            return redirect()->route('offerbanner.view')->with('success', 'banner Successfully updated without image');
        }
    }
    // banner Delete function
    public function delete($id)
    {
        $banner = OfferBanner::findOrFail($id);
        unlink(public_path('uploads/offer_banner/').$banner->image);
        $banner->delete();
        return back()->with('success', 'banner Successfully deleted');
    }
    // banner status Update function
    public function statusUpdate(Request $request,$id)
    {
        $banner = OfferBanner::findOrFail($id);
        if ($banner->status == 0) {
            $newStatus = 1;
        } else {
            $newStatus = 0;
        }

        $banner->update([
            'status'=>$newStatus
        ]);
        return redirect()->back()->with('success', 'status changed successfully');
        // dd($request->all());
        // $banner = OfferBanner::where('id',$id)->where('status', $request->status)->first();
        // if($banner->status == "0"){
        //     $banner->update([
        //         'status' => 1
        //     ]);
        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'Banner active successful',
        //     ]);
        // } else {
        //     $banner->update([
        //         'status' => 0
        //     ]);
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'Banner Inactive successful',
        //     ]);
        // }
    }

    public function viewAll(){
        $banners = OfferBanner::all();
        return response()->json([
            'offerbanners' => $banners,
            'status' => '200',
            'message' => 'Offerbanner fetched successfully',
        ]);
    }

    public function show($id){
        $banner = OfferBanner::find($id);
        return response()->json([
            'offerbanner' => $banner,
            'status' => '200',
            'message' => 'offerbanner Search successfully',
        ]);
    }
}
