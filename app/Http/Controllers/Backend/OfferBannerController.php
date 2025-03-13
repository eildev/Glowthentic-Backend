<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferBanner;
use App\Models\ImageGallery;
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


        $offerbanerCount = OfferBanner::count();
        if($offerbanerCount >= 5){
            return back()->with('error', 'You can not add more than Five banner');
        }

        else{

            $offerBanerAdd=new OfferBanner;
            $offerBanerAdd->head = $request->heading;
            $offerBanerAdd->title = $request->title;
            $offerBanerAdd->short_description = $request->short_description;
            $offerBanerAdd->link = $request->link;
            $offerBanerAdd->link_button = $request->link_button;
            $offerBanerAdd->status = $request->status;
            if($request->hasFile('image')){
                $file=$request->file('image');
                $extension=$file->extension();
                $fileName=time().'.'.$extension;
                $path='uploads/offer_banner/';
                $file->move($path,$fileName);
                $offerBanerAdd->image=$path.$fileName;
            }
            $offerBanerAdd->save();
            if($offerBanerAdd){
                if($offerBanerAdd->status=="cart1"){
                    if ($request->galleryimages) {
                        $allImages = $request->galleryimages;
                        foreach ($allImages as $galleryImage) {
                            $imageName = rand() . '.' . $galleryImage->extension();
                            $path= 'uploads/banner/gallery/';
                            $galleryImage->move(public_path('uploads/banner/gallery/'), $imageName);
                            $ImageGallery = new ImageGallery;
                            $ImageGallery->offer_banner_id =$offerBanerAdd->id;
                            $ImageGallery->image =$path.$imageName;
                            $ImageGallery->save();
                        }
                    }
                }
            }
          return back()->with('success', 'Offer Banner Added Successfully');

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
        $bannerContent = OfferBanner::with('images')->findOrFail($id);
        return view('backend.OfferBanner.edit', compact('bannerContent'));
    }


    // banner update function
    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|max:50',
            'title' => 'required|max:100',
            'short_description' => 'required|max:100',
            'link' => 'required|max:200',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $offerBanner = OfferBanner::findOrFail($id);
        $offerBanner->head = $request->heading;
        $offerBanner->title = $request->title;
        $offerBanner->short_description = $request->short_description;
        $offerBanner->link = $request->link;
        $offerBanner->link_button = $request->link_button ?? $offerBanner->link_button;
        $offerBanner->status = $request->status ?? $offerBanner->status;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete the old image
            if (file_exists(public_path($offerBanner->image)) && $offerBanner->image) {
                unlink(public_path($offerBanner->image));
            }

            $file = $request->file('image');
            $extension = $file->extension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/offer_banner/';
            $file->move(public_path($path), $fileName);
            $offerBanner->image = $path . $fileName;
        }

        $offerBanner->save();

        // Handle Gallery Images
        if ($offerBanner->status == "cart1" && $request->galleryimages) {
            foreach ($request->galleryimages as $galleryImage) {
                $imageName = rand() . '.' . $galleryImage->extension();
                $path = 'uploads/banner/gallery/';
                $galleryImage->move(public_path($path), $imageName);

                $imageGallery = new ImageGallery;
                $imageGallery->offer_banner_id = $offerBanner->id;
                $imageGallery->image = $path . $imageName;
                $imageGallery->save();
            }
        }

        return back()->with('success', 'Offer Banner Updated Successfully');
    }

    // banner Delete function
    public function delete($id)
    {
        $banner = OfferBanner::findOrFail($id);
        unlink(public_path('uploads/offer_banner/').$banner->image);
        $banner->delete();
        return back()->with('success', 'banner Successfully deleted');
    }

    //gallery Image Delete
    public function deleteImage($id)
        {
            $image = ImageGallery::findOrFail($id);
            $imagePath = public_path($image->image);


            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

       
            $image->delete();

            return back()->with('success', 'Image Successfully deleted');
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
