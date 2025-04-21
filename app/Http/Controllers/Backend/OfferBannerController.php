<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferBanner;
use App\Models\ImageGallery;
use App\Services\ImageOptimizerService;
use Exception;

use function PHPUnit\Framework\fileExists;

class OfferBannerController extends Controller
{
    // banner index function
    public function index()
    {
        return view('backend.OfferBanner.insert');
    }

    // banner store function
    public function store(Request $request, ImageOptimizerService $imageService)
    {
        // @dd($request->all());
        // $request->validate([
        //     'heading' => 'nullable|max:50',
        //     'title' => 'nullable|max:100',
        //     'short_description' => 'nullable|max:100',
        //     'link' => 'nullable|max:200',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        // ]);


        // $offerbanerCount = OfferBanner::count();
        // if ($offerbanerCount >= 5) {
        //     return back()->with('error', 'You can not add more than Five banner');
        // } else {

            $offerBanerAdd = new OfferBanner;
            $offerBanerAdd->head = $request->heading;
            $offerBanerAdd->title = $request->title;
            $offerBanerAdd->short_description = $request->short_description;
            $offerBanerAdd->link = $request->link;
            $offerBanerAdd->link_button = $request->link_button;
            $offerBanerAdd->status = $request->status;
            if ($request->hasFile('image')) {
                // $file=$request->file('image');
                // $extension=$file->extension();
                // $fileName=time().'.'.$extension;
                // $path='uploads/offer_banner/';
                // $file->move($path,$fileName);
                $destinationPath = public_path('uploads/offer_banner/');
                $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
                $offerBanerAdd->image = 'uploads/offer_banner/'. $imageName;
                // $offerBanerAdd->image='uploads/offer_banner/'.$fileName;
            }
            $offerBanerAdd->save();
            if ($offerBanerAdd) {
                if ($offerBanerAdd->status == "cart1") {
                    if ($request->galleryimages) {
                        $allImages = $request->galleryimages;
                        foreach ($allImages as $galleryImage) {
                            // $imageName = rand() . '.' . $galleryImage->extension();
                            // Generate a unique filename

                            $destinationPath = public_path('uploads/offer_banner/');
                            // $filename = time() . '_' . uniqid() . '.' . $galleryImage->extension();
                            $imageName = $imageService->resizeAndOptimize($galleryImage, $destinationPath);
                            $image = 'uploads/offer_banner/'.$imageName;

                            // $path= 'uploads/banner/gallery/';
                            // $galleryImage->move(public_path('uploads/banner/gallery/'), $imageName);
                            $ImageGallery = new ImageGallery;
                            $ImageGallery->offer_banner_id = $offerBanerAdd->id;
                            $ImageGallery->image = $image;
                            $ImageGallery->save();
                        }
                    }
                }
            }
            return back()->with('success', 'Offer Banner Added Successfully');
        // }
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
    public function update(Request $request, $id, ImageOptimizerService $imageService)
    {
        // $request->validate([
        //     'heading' => 'nullable|max:50',
        //     'title' => 'nullable|max:100',
        //     'short_description' => 'nullable|max:100',
        //     'link' => 'nullable|max:200',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        // ]);

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

            $destinationPath = public_path('uploads/offer_banner/');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $offerBanner->image = 'uploads/offer_banner/'.$imageName;
        }

        $offerBanner->save();

        // Handle Gallery Images
        if ($offerBanner->status == "cart1" && $request->galleryimages) {
            foreach ($request->galleryimages as $galleryImage) {
                // $imageName = rand() . '.' . $galleryImage->extension();
                // $path = 'uploads/banner/gallery/';
                // $galleryImage->move(public_path($path), $imageName);

                $destinationPath = public_path('uploads/offer_banner/');
                // $filename = time() . '_' . uniqid() . '.' . $galleryImage->extension();
                $imageName = $imageService->resizeAndOptimize($galleryImage, $destinationPath);
                $image = 'uploads/offer_banner/'.$imageName;

                $imageGallery = new ImageGallery;
                $imageGallery->offer_banner_id = $offerBanner->id;
                $imageGallery->image = $image;
                $imageGallery->save();
            }
        }

        return back()->with('success', 'Offer Banner Updated Successfully');
    }

    // banner Delete function
    public function delete($id)
    {
        $banner = OfferBanner::findOrFail($id);
        $galleryImages = ImageGallery::where('offer_banner_id', $id)->get();
        if (!empty($banner->image) && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }


        foreach ($galleryImages as $galleryImage) {
            $imagePath = public_path($galleryImage->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
            $galleryImage->delete();
        }

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
    public function statusUpdate(Request $request, $id)
    {
        $banner = OfferBanner::findOrFail($id);

        if ($banner->cart_status == "Active") {

            $banner->cart_status = "Inactive";
        } else {

            OfferBanner::where('status', $banner->status)
                ->where('id', '!=', $banner->id)
                ->update(['cart_status' => 'Inactive']);


            $banner->cart_status = "Active";
        }

        $banner->save();

        return redirect()->back()->with('success', 'Status changed successfully');
    }

    public function viewAll()
    {
        $banners = OfferBanner::all();
        return response()->json([
            'offerbanners' => $banners,
            'status' => '200',
            'message' => 'Offerbanner fetched successfully',
        ]);
    }

    public function show($id)
    {
        $banner = OfferBanner::find($id);
        return response()->json([
            'offerbanner' => $banner,
            'status' => '200',
            'message' => 'offerbanner Search successfully',
        ]);
    }
}
