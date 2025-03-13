<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Combo;
use App\Models\ComboImageGallery;
class ComboController extends Controller
{
    public function index()
    {
        return view('backend.combos.index');
    }

    public function store(Request $request){
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'offerd_price' => 'required|numeric|min:0',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'status' => 'required|in:active,inactive',
        // ]);

        // dd($request->all());

        $combo = new Combo();
        $combo->name = $request->combo_name;
        $combo->offerd_price = $request->combo_price;
        $combo->save();
        if($combo->id){
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $file=$image;
                $extension = $file->extension();
                $filename = time().'.'.$extension;
                $path ='uploads/combo/image/';
                $file->move($path,$filename);

                $combo_image = new ComboImageGallery();
                $combo_image->combo_id = $combo->id;
                $combo_image->image = $path.$filename;
                $combo_image->save();

            }
        }
    }
        return response()->json(['message' => 'Combo created successfully']);
    }



    public function view(){
        $combos = Combo::latest()->get();
       return response()->json([
        'status' => 200,
        'combos' => $combos,
       ]);
    }

    public function viewDeatils($id){
        $combo = Combo::findOrFail($id);
        $combo_image = ComboImageGallery::where('combo_id',$id)->get();
       return response()->json([
        'status' => 200,
        'combo' => $combo,
        'combo_image' => $combo_image,
       ]);
    }

    public function update(Request $request)
    {

        $combo = Combo::findOrFail($request->combo_id);
        $combo->name = $request->combo_name;
        $combo->offerd_price = $request->combo_price;
        $combo->save();
        if($combo->id){
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $file=$image;
                $extension = $file->extension();
                $filename = time() . '_' . uniqid() . '.' . $extension; 
                $path ='uploads/combo/image/';
                $file->move($path,$filename);

                $combo_image = new ComboImageGallery();
                $combo_image->combo_id = $combo->id;
                $combo_image->image = $path.$filename;
                $combo_image->save();

            }
        }
    }

        return response()->json(['message' => 'Combo updated successfully']);
    }


    public function delete(Request $request){
         $id=$request->id;
         $combo = Combo::find($id);
         if($combo){
            $combo->delete();
            return response()->json(['message'=>'Combo Deleted Successfully']);
         }
    }

    public function StatusChange(Request $request){
        $id=$request->status_id;

        $combo = Combo::find($id);
        if($combo->status == 'active'){
            $combo->status ='inactive';
            $combo->save();
        }
        else{
            $combo->status ='active';
            $combo->save();
        }
            return response()->json(['message'=>'Status Updated Successfully']);
        }

        public function comboDeleteImage(Request $request){
            $id=$request->image_id;
            $combo_image = ComboImageGallery::find($id);

            if($combo_image && file_exists($combo_image->image)){
                unlink($combo_image->image);
                $combo_image->delete();
                return response()->json([
                    'status'=>200,
                    'message'=>'Image Deleted Successfully'
                ]);
            }
        }
    }




