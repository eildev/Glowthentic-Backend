<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Carbon\Carbon;

class BlogCategoryController extends Controller
{
    public function AddBlogCategory(){
    return view('backend.blog_category.insert');
    }//End Method
    public function StoreBlogCategory(Request $request){
        $request->validate([
            'CategoryName' => 'required',
        ]);
        BlogCategory::insert([
            'cat_name' => $request->CategoryName,
            'created_at'=> Carbon::now(),
        ]);
    return redirect()->route('blog.all.category.view')->with('success', 'Blog Category Successfully Added');
    }//End Method
    public function BlogAllCategoryView(){
        $blogCat = BlogCategory::latest()->get();
        return view('backend.blog_category.show',compact('blogCat'));
    }//End Method
    public function EditBlogCategory($id){
        $blogCatEdit = BlogCategory::findOrFail($id);
        return view('backend.blog_category.edit',compact('blogCatEdit'));
    }//End Method
    public function UpdateBlogCategory(Request $request,$id){
        BlogCategory::findOrFail($id)->update([
            'cat_name' =>$request->CategoryName,
        ]);
        return redirect()->route('blog.all.category.view')->with('success', 'Blog Category Successfully Updated');
    }//End Method
    public function DeleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete();
        return redirect()->route('blog.all.category.view')->with('success', 'Blog Category Successfully Deleted');
    }


    //rest api start
   
}
