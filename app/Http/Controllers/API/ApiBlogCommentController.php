<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;

class ApiBlogCommentController extends Controller
{
      //Rest Api
      public function viewAll(){
        try{
            $blogComment = BlogComment::latest()->get();
            return response()->json([
                'blogComment' => $blogComment,
                'status' =>200,
                'messege' => 'Successfully Get Data',
            ]);
        }
      catch(\Exception $e){
        return response()->json([
            'status' => 500,
            'messege' => 'Something Went Wrong',
        ]);
      }
   }



   public function show($id){
        try{
            $blogComment = BlogComment::findOrFail($id);
            return response()->json([
                'blogComment' => $blogComment,
                'status' =>200,
                'messege' => 'Successfully Get Single Data',
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'messege' => 'Something Went Wrong',
            ]);
          }
       }
}
