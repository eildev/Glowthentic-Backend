<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogReact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogReactionController extends Controller
{
    public function BlogReact(Request $request){
        // dd($request);
        $val = $request->value;
        $react = BlogReact::where('user_id',Auth::user()->id)->where('blog_id',$request->post_id)->where('like', 1)->orWhere('dislike', 1)->first();

        // $react = BlogReact::where('user_id',Auth::user()->id)->where('blog_id',$request->post_id)->where('like', 1)->orWhere('love', 1)->orWhere('dislike', 1)->orWhere('haha', 1)->orWhere('angry', 1)->orWhere('sad', 1)->first();

        $like = BlogReact::where('blog_id',$request->post_id)->where('like', 1)->count();
        $dislike = BlogReact::where('blog_id',$request->post_id)->where('dislike', 1)->count();

       // $love = BlogReact::where('blog_id',$request->post_id)->where('love', 1)->count();
       // $haha = BlogReact::where('blog_id',$request->post_id)->where('haha', 1)->count();
      //  $angry = BlogReact::where('blog_id',$request->post_id)->where('angry', 1)->count();
       // $sad = BlogReact::where('blog_id',$request->post_id)->where('sad', 1)->count();

        if(!empty($react->id)){
           return response()->json([
                'status' => 500,
                'like'=> $like,
                'dislike'=>$dislike,
            ]);
        }else{
            $react = new BlogReact;
            $react->user_id = Auth::user()->id;
            $react->blog_id = $request->post_id;
            $react->$val = 1;
            $react->save();
            return response()->json([
                'status' => 200,
                'like'=>$like,
               'dislike'=>$dislike,
            ]);

        }
    }
}
