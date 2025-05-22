<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;
use App\Models\User;
class ApiBlogCommentController extends Controller
{
      //Rest Api
      public function viewAll(){
        try{
            $blogComment = BlogComment::with('user')->latest()->get();
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
            $blogComment = BlogComment::with('user')->findOrFail($id);
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



       public function store(Request $request){
        try{


            $user=User::where('id',$request->subscriber_id)->first();

            if($user){

                $blogComment=new BlogComment();
                $blogComment->blog_id=$request->blog_id;
                $blogComment->subscriber_id=$request->subscriber_id;
                $blogComment->comment=$request->comment;
                $blogComment->save();
                return response()->json([
                    'blogComment' => $blogComment,
                    'status' =>200,
                    'messege' => 'Successfully Created Data',
                ]);
            }
            else{
              return response()->json([
                    'status' => 500,
                    'messege' => 'No Blog Comment',
                ]);
            }

        }
        catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'messege' => $e->getMessage(), // ⬅️ This will show the actual error
            ]);
        }

       }


       public function userBlogGet($id){
        try{
            $blogComment = BlogComment::where('blog_id',$id)->get();
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
}
