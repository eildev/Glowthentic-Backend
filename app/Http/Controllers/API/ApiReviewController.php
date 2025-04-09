<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewRating;
use App\Models\ReviewImages;
use App\Services\ImageOptimizerService;
use Exception;
use App\Models\User;
use App\Models\OrderDetails;
class ApiReviewController extends Controller
{

    public function addReview(Request $request,ImageOptimizerService $imageService)
    {

        try{

            // dd($request->all());

            $request->validate([
                // 'product_id' => 'required',
                'user_id' => 'required',
                'rating' => 'required',
                'review' => 'required',
            ]);

            if($request->product_id && $request->order_id){
                $review = new ReviewRating();
                $review->product_id = $request->product_id;
                $review->user_id = $request->user_id;
                $review->order_id = $request->order_id;
                $review->rating = $request->rating;
                $review->review = $request->review;
                $review->status = $request->status;
                $review->save();


                if ( $review->id && $request->hasFile('images')){

                        $allImages =$request->file('images');
                        if (!is_array($allImages)) {
                            $allImages = [$allImages];
                        }
                        foreach ( $allImages as $image) {
                            //   dd("hello");
                            $destinationPath = public_path('uploads/review/Image/');

                            // Use $image instead of $images
                            $filename = time() . '_' . uniqid() . '.' . $image->extension();

                            // Use $image instead of $images
                            $imageName = $imageService->resizeAndOptimize($image, $destinationPath, $filename);
                            $imagePath = 'uploads/review/Image/' . $imageName;

                            $ImageGallery = new ReviewImages();
                            $ImageGallery->review_id = $review->id;
                            $ImageGallery->image = $imagePath;
                            $ImageGallery->save();
                        }
                    }

            }

            else if($request->order_id){

               $product=OrderDetails::where('order_id',$request->order_id)->get();
               foreach($product as $key => $value){
                $review = new ReviewRating();
                $review->product_id = $value->product_id;
                $review->user_id = $request->user_id;
                $review->order_id = $request->order_id;
                $review->rating = $request->rating;
                $review->review = $request->review;
                $review->status = $request->status;
                $review->save();
                if ( $review->id && $request->hasFile('images')){

                    $allImages =$request->file('images');
                    if (!is_array($allImages)) {
                        $allImages = [$allImages];
                    }
                    foreach ( $allImages as $image) {
                        //   dd("hello");
                        $destinationPath = public_path('uploads/review/Image/');

                        // Use $image instead of $images
                        $filename = time() . '_' . uniqid() . '.' . $image->extension();

                        // Use $image instead of $images
                        $imageName = $imageService->resizeAndOptimize($image, $destinationPath, $filename);
                        $imagePath = 'uploads/review/Image/' . $imageName;

                        $ImageGallery = new ReviewImages();
                        $ImageGallery->review_id = $review->id;
                        $ImageGallery->image = $imagePath;
                        $ImageGallery->save();
                    }
                }
            }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Review Added Successfully'
            ]);
        }
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add category.',
                'error' => $e->getMessage()
            ], 500);
        }


    }


    public function getReview($product_id){
        try{
            $reviews = ReviewRating::with('gallary', 'user.userDetails')
            ->where('product_id', $product_id)
            ->get();

        $transformed = $reviews->map(function ($review) {
            return [
                'id' => $review->id,
                'review' => $review->review,
                'rating' => $review->rating,
                'gallary' => $review->gallary,
                'user' => [
                    'name' => optional($review->user)->name,
                    'email' => optional($review->user)->email,
                ],
            ];
        });

        return response()->json([
            'status' => 200,
            'reviews' => $transformed,
        ]);
        }

        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add category.',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
