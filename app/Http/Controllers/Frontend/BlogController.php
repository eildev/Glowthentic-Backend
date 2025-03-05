<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
   public function BlogPostDetails($id){
    $singleBlog = BlogPost::findOrFail($id);
    /////////
    $blogComment = BlogComment::where('blog_id',$id)->orderBy('id','ASC')->get();
    ////////
    return view('frontend.indexContent.blog_details',compact('singleBlog','blogComment'));
    }//End Method
    public function AllBlogPost(){
        $allBlog = BlogPost::all();
        $blogCat = BlogCategory::latest()->limit(8)->get();
        $BlogSide = BlogPost::latest()->limit(5)->get();
        return view('frontend.indexContent.all_blog',compact('allBlog','blogCat','BlogSide'));
    }
}
