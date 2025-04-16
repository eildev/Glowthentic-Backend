<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogCategory;
use App\Services\ImageOptimizerService;
use Exception;
class BlogPostController extends Controller
{
    public function AddBlogPost(){
        $category = BlogCategory::all();
        return view('backend.blog_post.insert',compact('category'));
    }
    public function StoreBlogPost(Request $request, ImageOptimizerService $imageService) {
        $request->validate([
            'title' => 'required|max:200',
            'category' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        if ($request->image) {

            // $imageName = rand() . '.' . $request->image->extension();
            // $request->image->move(public_path('uploads/blog/blog_post/'), $imageName);

            $destinationPath = public_path('uploads/blog/blog_post/');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $image='uploads/blog/blog_post/'.$imageName;

            $blog = new BlogPost;
            $blog->cat_id = $request->category;
            $blog->user_id = Auth::user()->id;
            $blog->title = $request->title;
            $blog->desc = $request->description;
            $blog->tags = $request->tags;
            $blog->image = $image;
            $blog->save();

            return redirect()->route('blog.all.post.view')->with('success', 'Blog Post Successfully Saved');
        }
    }//End MEthod
    public function allBlogPostView(){
        $blogPost = BlogPost::latest()->get();
        return view('backend.blog_post.show',compact('blogPost'));
    }//End Method
    public function BlogPostEdit($id){
        $cate = BlogCategory::all();
        $blogPost = BlogPost::findOrFail($id);
        return view('backend.blog_post.edit',compact('cate','blogPost'));
    }//End Method
    public function BlogPostupdate(Request $request,$id,ImageOptimizerService $imageService){
        if ($request->image) {
            $request->validate([
                'title' => 'required|max:200',
                'category' => 'required',
                'description' => 'required',
                'tags' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            ]);
            $destinationPath = public_path('uploads/blog/blog_post/');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $image='uploads/blog/blog_post/'.$imageName;
            $blog = BlogPost::findOrFail($id);
            $file = public_path('uploads/blog/blog_post/' . $blog->image);
            if (file_exists($file)) {
                unlink($file);
            }

            $blog->cat_id = $request->category;
            $blog->user_id = Auth::user()->id;
            $blog->title = $request->title;
            $blog->desc = $request->description;
            $blog->tags = $request->tags;
            $blog->image = $image;
            $blog->update();
            return redirect()->route('blog.all.post.view')->with('success', 'Blog Successfully updated With Image');
        } else {
            $request->validate([
                'title' => 'required|max:200',
                'category' => 'required',
                'description' => 'required',
                'tags' => 'required',
            ]);
            $blog = BlogPost::findOrFail($id);
            $blog->cat_id = $request->category;
            $blog->user_id = Auth::user()->id;
            $blog->title = $request->title;
            $blog->desc = $request->description;
            $blog->tags = $request->tags;
            $blog->update();
            $blog->update();
            return redirect()->route('blog.all.post.view')->with('success', 'Blog Successfully updated Without Image');
        }//
    }//
    public function BlogPostDelete($id){
        $delete = BlogPost::findOrFail($id);
        $path = public_path('uploads/blog/blog_post/'.$delete->image);
        if(file_exists($path)){
            @unlink($path);
        }
        BlogPost::findOrFail($id)->delete();
        return redirect()->route('blog.all.post.view')->with('success', 'Blog Post Successfully Deleted');
    }
    public function BlogActiveToInactive($id){
        BlogPost::findOrFail($id)->update([
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Blog Inactive Successfully');;
    }//End Method
    public function BlogInctiveToActive($id){
        BlogPost::findOrFail($id)->update([
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Blog Active Successfully');;
    }//End Method

    //rest api

}
