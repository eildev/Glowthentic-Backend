<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogCategory;

class ApiBlogPostController extends Controller
{

    public function viewAll(){
        try{
            $blogPost = BlogPost::all();
            return response()->json([
                'blogPost' => $blogPost,
                'status'=>200,
                'messege' => 'Blog Post Get Successfully'
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status'=>500,
                'messege' => 'Something Went Wrong'
            ]);
        }

}

public function show($id){
    try{
        $blogPost = BlogPost::findOrFail($id);
        return response()->json([
            'blogPost' => $blogPost,
            'status'=>200,
            'messege' => 'Blog Post Get Successfully'
        ]);
    }
    catch(\Exception $e){
        return response()->json([
            'status'=>500,
            'messege' => 'Something Went Wrong'
        ]);
    }

}
}
