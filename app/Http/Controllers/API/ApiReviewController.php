<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewImages;
class ApiReviewController extends Controller
{
    
    public function addReview(Request $request)
    {

        try{
            $request->validate([
                'product_id' => 'required',
                'user_id' => 'required',
                'rating' => 'required',
                'review' => 'required',
            ]);
            $review = new Review();
            $review->product_id = $request->product_id;
            $review->user_id = $request->user_id;
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->status = $request->status;
            $review->save();
             
        
                if ($request->images) {
                    $allImages = $request->images;
                    foreach ($allImages as $images) {
                        // $imageName = rand() . '.' . $galleryImage->extension();
                        // Generate a unique filename
    
                        $destinationPath = public_path('uploads/review/Image');
                        $filename = time() . '_' . uniqid() . '.' . $images->extension();
                        $imageName = $imageService->resizeAndOptimize($images, $destinationPath,$filename);
                        $image='uploads/review/Image'.$imageName;
    
                        // $path= 'uploads/banner/gallery/';
                        // $galleryImage->move(public_path('uploads/banner/gallery/'), $imageName);
                        $ImageGallery = new ReviewImages();
                        $ImageGallery->review_id =$review->id;
                        $ImageGallery->image =$image;
                        $ImageGallery->save();
                    }
                }
            
    
    
            return response()->json([
                'status' => 200,
                'message' => 'Review Added Successfully'
            ]);
        }
       catch(Exception $e){
           return response()->json(['message' => 'Something went wrong']);
       }

        
    }
}
