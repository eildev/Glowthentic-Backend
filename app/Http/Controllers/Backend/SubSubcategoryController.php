<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubSubcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubSubcategoryController extends Controller
{
     // sub subcategory index function
     public function index()
     {
         return view('backend.subsubcategory.insert');
     }

     // sub subcategory store function
    public function store(Request $request)
    {
        $request->validate([
            'subcategoryId' => 'required',
            'subSubcategoryName' => 'required|max:100',
        ]);
        $sub_subcategory = new SubSubcategory;
        $sub_subcategory->subSubcategoryName = $request->subSubcategoryName;
        $sub_subcategory->subcategoryId = $request->subcategoryId;
        $sub_subcategory->slug = Str::slug($request->subSubcategoryName);
        $sub_subcategory->save();
        return back()->with('success', 'Sub-Subcategory Successfully Saved');
    }

    // sub subcategory View function
    public function view()
    {
        $sub_subcategories = SubSubcategory::all();
        return view('backend.subsubcategory.view', compact('sub_subcategories'));
    }

    // sub subcategory edit function
    public function edit($id)
    {
        $sub_subcategory = SubSubcategory::findOrFail($id);
        return view('backend.subsubcategory.edit', compact('sub_subcategory'));
    }

     // sub subcategory update function
     public function update(Request $request, $id)
     {
         $request->validate([
             'subcategoryId' => 'required',
             'subSubcategoryName' => 'required|max:100',
         ]);
         $sub_subcategory = SubSubcategory::findOrFail($id);
         $sub_subcategory->subSubcategoryName = $request->subSubcategoryName;
         $sub_subcategory->subcategoryId = $request->subcategoryId;
         $sub_subcategory->slug = Str::slug($request->subSubcategoryName);
         $sub_subcategory->update();
         return redirect()->route('sub.subcategory.view')->with('success', 'Sub-Subcategory Successfully Updated');
     }
     // sub subcategory delete function
    public function delete($id)
    {
        $sub_subcategory = SubSubcategory::findOrFail($id);
        $sub_subcategory->delete();
        return back()->with('success', 'Sub-Subcategory Deleted successfully');
    }
    // find sub subcategory
    public function findSubSubcat($id)
    {
        $subsubcats = SubSubcategory::where('subcategoryId', $id)->get();
        if($subsubcats){
            return response()->json([
                'status' => 200,
                'subsubcats' => $subsubcats
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "no data found"
            ]);
        }
    }
}
