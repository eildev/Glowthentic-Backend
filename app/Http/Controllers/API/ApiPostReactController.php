<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogReact;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class ApiPostReactController extends Controller
{
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'blog_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages(),
                ]);
            }
              $user = User::find($request->user_id);

              if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found',
                ]);
            }
            $blogReact = new BlogReact();
            $blogReact->user_id = $request->user_id;
            $blogReact->blog_id = $request->blog_id;
            $blogReact->like = $request->like;
            if($request->like == 1){
                $blogReact->dislike = 0;
            }
            else{
                $blogReact->like = 0;
                $blogReact->dislike = $request->dislike;
            }


            $blogReact->save();
            return response()->json([
                'status' => 200,
                'message' => 'Blog React Added Successfully',
                'data' => $blogReact
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function show($blog_id){
        try{
            $blogReact = BlogReact::with('user')->where('blog_id',$blog_id)->first();
            return response()->json([
                'status' => 200,
                'message' => 'Blog React Get Successfully',
                'data' => $blogReact
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
