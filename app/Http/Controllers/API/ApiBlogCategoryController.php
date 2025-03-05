<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Carbon\Carbon;

class ApiBlogCategoryController extends Controller
{
    public function viewAll(){
        $blogCat = BlogCategory::latest()->get();
       return response()->json([
        'blogCat' => $blogCat,
        'status' => 200,
        'message' => 'Blog Category Get Successfully',
       ]);
    }

    public  function show($id){
        try{
            $blogCat = BlogCategory::find($id);
            return response()->json([
                'blogCat' => $blogCat,
                'status' => 200,
                'message' => 'Blog Search Successfully',
               ]);
        }

        catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }

    }
}
